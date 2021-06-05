<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Shared\Domain\ValueObjects\ToursCollection;
use ApiInmuebles\Shared\Infrastructure\Helper\Faker;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\valueObjects\TourIdStub;

final class ToursCollectionStub
{
    public static function random(int $items, PropertyId $propertyId): ToursCollection
    {
        $tours = [];
        for($i=0; $i<$items; $i++) {
            $tours[] = new Tour(
                TourIdStub::random(),
                Faker::bool(),
                $propertyId
            );
        }

        return new ToursCollection($tours);
    }

    public static function create(array $tours): ToursCollection
    {
        return new ToursCollection($tours);
    }
}