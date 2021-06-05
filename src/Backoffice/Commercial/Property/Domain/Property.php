<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain;

use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\UpdatePropertyCommand;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;


final class Property
{
    private PropertyId $id;
    private PropertyTitle $title;
    private PropertyDescription $description;

    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
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

    public function updateProperty(UpdatePropertyCommand $command): void
    {
        $this->title = new PropertyTitle($command->title());
        $this->description = new PropertyDescription($command->description());
    }
}