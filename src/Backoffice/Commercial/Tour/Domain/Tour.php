<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;

final class Tour
{
    private TourId $id;
    private bool $active;
    private PropertyId $property;

    public function __construct(TourId $id, bool $active, PropertyId $property)
    {
        $this->id = $id;
        $this->active = $active;
        $this->property = $property;
    }

    public function id(): TourId
    {
        return $this->id;
    }

    public function active(): bool
    {
        return $this->active;
    }

    public function property(): PropertyId
    {
        return $this->property;
    }

}