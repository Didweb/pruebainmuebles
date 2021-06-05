<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\valueObjects;


use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;
use ApiInmuebles\Shared\Infrastructure\Helper\Faker;

final class TourIdStub
{
    public static function random(): TourId
    {
        return TourId::create(Faker::uuid());
    }

    public static function create(string $generId): TourId
    {
        return TourId::create($generId);
    }
}