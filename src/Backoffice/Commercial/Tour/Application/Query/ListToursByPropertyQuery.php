<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Query;


use ApiInmuebles\Shared\Domain\Messenger\Query\Query;

final class ListToursByPropertyQuery extends Query
{
    private string $propertyId;

    public function __construct(string $propertyId)
    {
        $this->propertyId = $propertyId;
    }

    public function propertyId(): string
    {
        return $this->propertyId;
    }
}