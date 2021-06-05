<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Domain\ValueObjects;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;


final class ToursCollection extends ValueObjectCollection
{
    public static function create(array $valueObjects): ToursCollection
    {
        $array = [];
        foreach ($valueObjects as $tour) {
            $active = ($tour['active'] = '1')? true: false;
            $array[] = new Tour(
                            TourId::create($tour['id']),
                            $active,
                            PropertyId::create($tour['property'])
            );
        }

        return new self($array);
    }

}