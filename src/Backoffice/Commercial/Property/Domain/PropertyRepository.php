<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain;

use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;

interface PropertyRepository
{
    public function save(Property $property): void;

    public function find(PropertyId $propertyId): ?Property;

}