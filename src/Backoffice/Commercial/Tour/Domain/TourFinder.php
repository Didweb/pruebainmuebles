<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Exceptions\TourNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;

final class TourFinder
{
    private TourRepository $repository;

    public function __construct(TourRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(TourId $tourId): Tour
    {
        $tour = $this->repository->find($tourId);

        if (null === $tour) {
            throw TourNotFoundException::ofId($tourId);
        }

        return $tour;
    }

}