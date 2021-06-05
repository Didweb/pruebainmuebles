<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Services;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyFinder;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyRepository;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\CreateTourCommand;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourRepository;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;

final class CreateTour
{
    private TourRepository $repository;
    private PropertyFinder $propertyFinder;

    public function __construct(
        TourRepository $repository,
        PropertyRepository $propertyRepository
    ) {
        $this->repository = $repository;
        $this->propertyFinder = new PropertyFinder($propertyRepository);
    }

    public function __invoke(CreateTourCommand $command): void
    {
        $property = $this->existsPropertyId($command->property());

        $active = $command->active() == '1';

        $tour = new Tour(
            TourId::create($command->id()),
            $property,
            $active,
        );

        $this->repository->save($tour);
    }

    private function existsPropertyId(string $propertyId): Property
    {
        $propertyId = PropertyId::create($propertyId);

        return $this->propertyFinder->__invoke($propertyId);
    }

}