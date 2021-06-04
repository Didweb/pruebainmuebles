<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Infrastructure\Doctrine\Type;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PropertyIdType
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

        return PropertyId::create($value);
    }
}