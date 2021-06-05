<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Infrastructure\Helper;


use Faker\Factory;

final class Faker
{
    private const LANG = 'es_ES';

    public static function word(): string
    {
        return Factory::create(self::LANG)->word();
    }

    public static function uuid(): string
    {
        return Factory::create(self::LANG)->uuid;
    }

    public static function text(): string
    {
        return Factory::create(self::LANG)->text;
    }

    public static function bool(): bool
    {
        return Factory::create(self::LANG)->boolean;
    }
}