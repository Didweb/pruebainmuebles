<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Shared\Infrastructure\Helper\Faker;

final class PropertyIdStub
{
    public static function random(): PropertyId
    {
        return PropertyId::create(Faker::uuid());
    }

    public static function create(string $generId): PropertyId
    {
        return PropertyId::create($generId);
    }
}