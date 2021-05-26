<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Gener\Domain;

interface GenerRepository
{
    public function save(Gener $gener): void;

    public function findByName(string $name): ?Gener;
}