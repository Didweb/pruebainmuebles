<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Shared\Domain\ValueObjects\ToursCollection;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescriptionStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyIdStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitleStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\ToursCollectionStub;

final class PropertyStub
{
    public static function random(int $items): Property
    {
        $propertyId = PropertyIdStub::random();
        return new Property(
            $propertyId,
            PropertyTitleStub::random(),
            PropertyDescriptionStub::random(),
            ToursCollectionStub::random($items, $propertyId),
        );
    }

    public static function create(
        PropertyId $propertyId,
        PropertyTitle $title,
        PropertyDescription $description,
        ToursCollection $tours
    ): Property
    {
        return new Property(
            $propertyId,
            $title,
            $description,
            $tours,
        );
    }
}