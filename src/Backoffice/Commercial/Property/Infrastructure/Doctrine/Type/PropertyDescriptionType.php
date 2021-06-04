<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Infrastructure\Doctrine\Type;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PropertyDescriptionType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (!$value) {
            return null;
        }
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?PropertyDescription
    {
        if (!$value) {
            return null;
        }

        return new PropertyDescription($value);
    }
}