<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Domain\ValueObjects;


use ApiInmuebles\Shared\Domain\ValueObjects\Exception\UuidValueException;

class Uuid
{
    private string $id;

    private final function __construct(string $id)
    {
        $this->id = $id;
    }

    /** @return static */
    public static function create(string $uuid)
    {
        if (!\Ramsey\Uuid\Nonstandard\Uuid::isValid($uuid)) {
            throw UuidValueException::notValid($uuid);
        }

        return new static($uuid);
    }

    public static function next(): string
    {
        return \Ramsey\Uuid\Nonstandard\Uuid::uuid4()->toString();
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(self $uuid): bool
    {
        return $this->id === $uuid->id;
    }


}