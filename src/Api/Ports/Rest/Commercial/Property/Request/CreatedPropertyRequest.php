<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Property\Request;


use InvalidArgumentException;

final class CreatedPropertyRequest
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

    public static function fromContent(array $content): self
    {
        $content = $content['property'][0];

        if (!isset($content['id'])
            || !isset($content['title'])
        ) {
            throw new InvalidArgumentException('Fields id and title are required');
        }

        return new self(
            $content['id'],
            $content['title'],
            $content['description']
        );
    }
}