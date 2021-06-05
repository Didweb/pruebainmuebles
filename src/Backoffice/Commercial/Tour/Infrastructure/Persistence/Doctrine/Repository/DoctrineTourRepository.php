<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Infrastructure\Persistence\Doctrine\Repository;


use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourRepository;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class DoctrineTourRepository implements TourRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Tour::class);
        $this->repository = $repository;
    }
    public function save(Tour $tour): void
    {
        $this->em->persist($tour);
    }


    public function find(TourId $tourId): ?Tour
    {
        return  $this->repository->find($tourId);

    }
}