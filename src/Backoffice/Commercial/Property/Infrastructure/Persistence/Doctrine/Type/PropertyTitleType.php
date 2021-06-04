<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Infrastructure\Persistence\Doctrine\Type;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class PropertyTitleType
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

        return new PropertyTitle($value);
    }
}