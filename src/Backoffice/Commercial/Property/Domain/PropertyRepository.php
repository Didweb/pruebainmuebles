<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Domain;


interface PropertyRepository
{
    public function save(Property $property): void;

    public function update(Property $property): void;
}