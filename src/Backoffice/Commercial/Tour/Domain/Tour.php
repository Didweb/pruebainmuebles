<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;

final class Tour
{
    private TourId $id;
    private bool $active;
    private Property $property;

    public function __construct(TourId $id, Property $property, bool $active)
    {
        $this->id = $id;
        $this->property = $property;
        $this->active = $active;
    }

    public function id(): TourId
    {
        return $this->id;
    }

    public function property(): Property
    {
        return $this->property;
    }

    public function active(): bool
    {
        return $this->active;
    }

}