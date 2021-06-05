<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Services;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyFinder;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyRepository;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\UpdateTourCommand;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourFinder;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourRepository;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;

final class UpdateTour
{
    private TourFinder $tourFinder;
    private PropertyFinder $propertyFinder;
    private TourRepository $tourRepository;

    public function __construct(TourRepository $tourRepository, PropertyRepository $propertyRepository)
    {
        $this->tourRepository = $tourRepository;
        $this->tourFinder = new TourFinder($tourRepository);
        $this->propertyFinder = new PropertyFinder($propertyRepository);

    }

    public function __invoke(UpdateTourCommand $command): void
    {
        $tour = $this->tourFinder->__invoke(TourId::create($command->id()));

        $property = $this->propertyFinder->__invoke(PropertyId::create($command->property()));

        $tour->updateTour($tour);

        $this->tourRepository->save($tour);
    }

}