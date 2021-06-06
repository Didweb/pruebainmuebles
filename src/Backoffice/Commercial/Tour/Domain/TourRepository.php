<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;

use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;

interface TourRepository
{
    public function save(Tour $tour): void;

    public function find(TourId $tourId): ?Tour;

    public function findByProperty(Property $property): array;
}