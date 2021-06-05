<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Tour\Request;


use InvalidArgumentException;

final class UpdateTourRequest
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

    public static function fromContent(array $content): self
    {
        $content = $content['tour'][0];

        if (!isset($content['id'])
            || !isset($content['property'])
        ) {
            throw new InvalidArgumentException('Fields id and property are required');
        }

        return new self(
            $content['id'],
            $content['property'],
            $content['active']
        );
    }
}