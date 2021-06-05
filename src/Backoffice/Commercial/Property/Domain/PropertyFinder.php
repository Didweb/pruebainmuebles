<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;

final class PropertyFinder
{
    private PropertyRepository $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PropertyId $propertyId): Property
    {
        $property = $this->repository->find($propertyId);

        if (null === $property) {
            throw  PropertyNotFoundException::ofId($propertyId);
        }

        return $property;
    }

}