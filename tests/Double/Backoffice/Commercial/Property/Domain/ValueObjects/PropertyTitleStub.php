<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Shared\Infrastructure\Helper\Faker;

final class PropertyTitleStub
{
    public static function random(): PropertyTitle
    {
        return new PropertyTitle(Faker::word());
    }

    public static function create(string $title): PropertyTitle
    {
        return new PropertyTitle($title);
    }
}