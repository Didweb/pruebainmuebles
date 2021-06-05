<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Command;


use ApiInmuebles\Shared\Domain\Messenger\Command\Command;

final class UpdateTourCommand extends Command
{
    private string $id;
    private string $property;
    private string $active;

    public function __construct(string $id, string $property, string $active)
    {
        $this->id = $id;
        $this->property = $property;
        $this->active = $active;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function property(): string
    {
        return $this->property;
    }

    public function active(): string
    {
        return $this->active;
    }

    public function _toArray(): array
    {
        return [
            'id' => $this->id(),
            'property' => $this->property(),
            'active' => $this->active()
        ];
    }

}