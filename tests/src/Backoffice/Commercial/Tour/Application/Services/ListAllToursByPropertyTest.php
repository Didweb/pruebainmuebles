<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\src\Backoffice\Commercial\Tour\Application\Services;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyFinder;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Services\ListAllToursByProperty;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\TourFinderByPropertyId;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ToursByPropertyResponse;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyIdStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\TourInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\TourStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\valueObjects\TourIdStub;
use PHPUnit\Framework\TestCase;

final class ListAllToursByPropertyTest extends TestCase
{
    private ListAllToursByProperty $useCase;
    private Tour $tourFirstItem;
    private Tour $tourSecondItem;
    private Property $property;

    protected function setUp(): void
    {
        $tourRepository = TourInMemoryRepository::empty();
        $propertyRepository = PropertyInMemoryRepository::empty();

        $this->property = PropertyStub::random();
        $propertyRepository->save($this->property);

        $this->tourFirstItem = TourStub::create(
            TourIdStub::random(),
            $this->property,
            true
        );

        $this->tourSecondItem = TourStub::create(
            TourIdStub::random(),
            $this->property,
            false
        );

        $tourRepository->save($this->tourFirstItem);
        $tourRepository->save($this->tourSecondItem);

        $tourFinder = new TourFinderByPropertyId($tourRepository);
        $propertyFinder = new PropertyFinder($propertyRepository);

        $this->useCase = new ListAllToursByProperty($tourFinder, $propertyFinder);

        parent::setUp();
    }


    public function test_should_list_tours_by_property_when_exist(): void
    {

        $response = new ToursByPropertyResponse((string)$this->property->id());

        $responseList = $this->useCase->__invoke($response);

        $this->assertEquals($responseList->propertyId(), $this->property->id());
        $this->assertEquals($responseList->tours()[0]['id'], $this->tourFirstItem->id());
        $this->assertEquals($responseList->tours()[1]['id'], $this->tourSecondItem->id());
    }

    public function test_should_list_tours_by_property_when_not_exist_property(): void
    {
        $this->expectException(PropertyNotFoundException::class);

        $response = new ToursByPropertyResponse((string)PropertyIdStub::random());

        $this->useCase->__invoke($response);

    }

}