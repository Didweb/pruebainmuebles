<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundInListToursException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;

final class TourFinderByPropertyId
{
    private TourRepository $repository;

    public function __construct(TourRepository $repository)
    {
        $this->repository = $repository;
    }
    public function __invoke(?Property $property): ?array
    {

        if (null === $property) {
            throw PropertyNotFoundInListToursException::ofId();
        }

        $tours = $this->repository->findByProperty($property);


        return $tours;
    }
}