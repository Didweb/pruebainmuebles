<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Exceptions\TourNotFoundException;

final class TourFinderByPropertyId
{
    private TourRepository $repository;

    public function __construct(TourRepository $repository)
    {
        $this->repository = $repository;
    }
    public function __invoke(Property $property): ?array
    {
        $tours = $this->repository->findByProperty($property);

        if (null === $tours) {
            throw PropertyNotFoundException::ofId($property->id());
        }

        return $tours;
    }
}