<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Infrastructure\Persistence\Doctrine\Type;


use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class TourIdType  extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }

        return TourId::create($value);
    }
}