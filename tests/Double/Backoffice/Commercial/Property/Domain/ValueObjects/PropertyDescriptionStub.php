<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use ApiInmuebles\Shared\Infrastructure\Helper\Faker;

final class PropertyDescriptionStub
{
    public static function random(): PropertyDescription
    {
        return new PropertyDescription(Faker::text());
    }

    public static function create(string $description): PropertyDescription
    {
        return new PropertyDescription($description);
    }
}