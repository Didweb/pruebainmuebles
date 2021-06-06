<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;
use ApiInmuebles\Shared\Infrastructure\Helper\Faker;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\ValueObjects\TourIdStub;

final class TourStub
{
    public static function random(): Tour
    {
        return new Tour(
            TourIdStub::random(),
            PropertyStub::random(),
            Faker::bool()
        );
    }

    public static function create(
        TourId $tourId,
        Property $property,
        bool $active
    ): Tour
    {
        return new Tour(
            $tourId,
            $property,
            $active
        );
    }
}