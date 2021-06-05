<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain\Exceptions;


use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class TourNotFoundException extends HttpException
{
    public static function ofId(TourId $tourId): self
    {
        return new self(404,
                        sprintf('Tour with id <%s> not found', (string)$tourId)
        );
    }
}