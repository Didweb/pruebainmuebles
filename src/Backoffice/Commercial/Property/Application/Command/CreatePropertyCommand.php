<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Application\Command;


use ApiInmuebles\Shared\Domain\Messenger\Command\Command;

final class CreatePropertyCommand extends Command
{
    private string $id;
    private string $title;
    private string $description;

    public function __construct(string $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function _toArray(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'description' => $this->description(),
        ];
    }
}