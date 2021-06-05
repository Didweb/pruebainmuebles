<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Domain\ValueObjects;


use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;


final class ToursCollection extends ValueObjectCollection
{
    public static function create(array $tours): self
    {
        $array = [];
        foreach ($tours as $tour) {
            $array[] = new Tour($tour->id(), $tour->active(), $tour->property());
        }

        return new self($array);
    }

}