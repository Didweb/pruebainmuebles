<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Infrastructure\Doctrine\Repository;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyRepository;

final class DoctrinePropertyRepository implements PropertyRepository
{

    public function save(Property $property): void
    {
        // TODO: Implement save() method.
    }

    public function update(Property $property): void
    {
        // TODO: Implement update() method.
    }
}