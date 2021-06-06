<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourRepository;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ValueObjects\TourId;
use Doctrine\Common\Collections\ArrayCollection;

final class TourInMemoryRepository
{
    public static function empty(): TourRepository
    {
        return self::repository([]);
    }

    private static function repository(array $crmData): TourRepository
    {
        return (
        new class($crmData) implements TourRepository
        {
            private ArrayCollection $arrayCollection;

            public function __construct(?array $crmData)
            {
                $this->arrayCollection = new ArrayCollection($crmData);
            }

            public function save(Tour $tour): void
            {
                if ($this->arrayCollection->contains($tour)) {
                    $this->arrayCollection->removeElement($tour);
                    $this->arrayCollection->add($tour);
                } else {
                    $this->arrayCollection->add($tour);
                }

            }


            public function find(TourId $tourId): ?Tour
            {
                $filter = $this->arrayCollection->filter(
                    function (Tour $tour) use ($tourId) {
                        return $tour->id()->equals($tourId);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function findByProperty(Property $property): array
            {
               $result = [];
//                $filter = $this->arrayCollection->filter(
//                    function (Tour $tour) use ($property) {
//                        if((string)$tour->property()->id() == (string)$property->id()){
//                            $result[] = $tour;
//                        }
//                    }
//                );

                foreach($this->arrayCollection as $items) {
                    if($items->property()->id() == $property->id()) {
                        $result[] = $items;
                    }
                }
                return $result;


            }
        }
        );
    }
}