<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PropertyNotFoundInListToursException extends HttpException
{
    public static function ofId(): self
    {
        return new self(404,
                        'Property  not found'
        );
    }
}