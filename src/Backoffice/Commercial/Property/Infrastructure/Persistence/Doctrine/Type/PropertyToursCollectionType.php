<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Infrastructure\Persistence\Doctrine\Type;


use ApiInmuebles\Shared\Domain\ValueObjects\ToursCollection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class PropertyToursCollectionType extends StringType
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

        return new ToursCollection($value);
    }
}