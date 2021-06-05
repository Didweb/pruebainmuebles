<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyRepository;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use Doctrine\Common\Collections\ArrayCollection;

final class PropertyInMemoryRepository
{
    public static function empty(): PropertyRepository
    {
        return self::repository([]);
    }

    private static function repository(array $crmData): PropertyRepository
    {
        return (
        new class($crmData) implements PropertyRepository
        {
            private ArrayCollection $arrayCollection;

            public function __construct(?array $crmData)
            {
                $this->arrayCollection = new ArrayCollection($crmData);
            }

            public function save(Property $property): void
            {
                if ($this->arrayCollection->contains($property)) {
                    $this->arrayCollection->removeElement($property);
                    $this->arrayCollection->add($property);
                } else {
                    $this->arrayCollection->add($property);
                }
            }


            public function find(PropertyId $propertyId): ?Property
            {
                $filter = $this->arrayCollection->filter(
                    function (Property $property) use ($propertyId) {
                        return $property->id()->equals($propertyId);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }
        }
        );
    }
}