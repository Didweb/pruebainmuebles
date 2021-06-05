<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PropertyNotFoundException extends HttpException
{
    public static function ofId(PropertyId $propertyId): self
    {
        return new self(404,
                        sprintf('Property with id <%s> not found', (string)$propertyId)
        );
    }
}