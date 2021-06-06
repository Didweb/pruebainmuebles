<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Query;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyFinder;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourFinderByPropertyId;

final class ListToursByPropertyQueryHandler
{
    private TourFinderByPropertyId $tourFinder;
    private PropertyFinder $propertyFinder;

    public function __construct(TourFinderByPropertyId $tourFinder, PropertyFinder $propertyFinder)
    {
        $this->tourFinder = $tourFinder;
        $this->propertyFinder = $propertyFinder;
    }

    public function __invoke(ListToursByPropertyQuery $query): ?array
    {
        $property = $this->propertyFinder->__invoke(PropertyId::create($query->propertyId()));

        return $this->tourFinder->__invoke($property);
    }

}