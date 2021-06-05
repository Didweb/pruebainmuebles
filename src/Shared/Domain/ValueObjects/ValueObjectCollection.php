<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Domain\ValueObjects;


abstract class ValueObjectCollection
{
    private array $collection;

    public function __construct(array $valueObjects)
    {
        $this->collection = $valueObjects;
    }

    public function collection(): array
    {
        return $this->collection;
    }

    /** @return static */
    abstract public static function create(array $valueObjects);

    public function encode(): string
    {
        return (string)json_encode($this->toArray());
    }

    public static function decode(string $collection): array
    {
        return json_decode($collection, true);
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this->collection as $valueObject) {
            if ($valueObject instanceof Enum) {
                $result[] = (string) $valueObject;
                continue;
            }

            $result[] = $valueObject->toArray();
        }

        return $result;
    }
}