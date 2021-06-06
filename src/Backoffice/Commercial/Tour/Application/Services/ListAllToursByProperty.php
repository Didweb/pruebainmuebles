<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Services;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyFinder;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourFinderByPropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ToursByPropertyResponse;

final class ListAllToursByProperty
{
    private TourFinderByPropertyId $tourFinder;
    private PropertyFinder $propertyFinder;

    public function __construct(
        TourFinderByPropertyId $tourFinder,
        PropertyFinder $propertyFinder
    ) {
        $this->tourFinder = $tourFinder;
        $this->propertyFinder = $propertyFinder;
    }

    public function __invoke(ToursByPropertyResponse $response): ?ToursByPropertyResponse
    {
        $property = $this->propertyFinder->__invoke(PropertyId::create($response->propertyId()));

        $response->updateTours($this->tourFinder->__invoke($property));

        $toursResponse = new ToursByPropertyResponse(
            (string)$property->id(),
            $response->tours()
        );

        return $toursResponse;
    }
}