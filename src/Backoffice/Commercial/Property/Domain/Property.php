<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain;

use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use ApiInmuebles\Shared\Domain\ValueObjects\ToursCollection;


final class Property
{
    private PropertyId $id;
    private PropertyTitle $title;
    private PropertyDescription $description;
    private ToursCollection $tours;

    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        ToursCollection $tours
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->tours = $tours;
    }

    public function id(): PropertyId
    {
        return $this->id;
    }

    public function title(): PropertyTitle
    {
        return $this->title;
    }

    public function description(): PropertyDescription
    {
        return $this->description;
    }

    public function tours(): ToursCollection
    {
        return $this->tours;
    }

}