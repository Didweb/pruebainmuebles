<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\src\Backoffice\Commercial\Tour\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\UpdateTourCommand;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\UpdateTourCommandHandler;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Services\UpdateTour;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Exceptions\TourNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\Tour;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyIdStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\TourInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\TourStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\valueObjects\TourIdStub;
use PHPUnit\Framework\TestCase;

final class UpdateTourCommandHandlerTest extends TestCase
{
    private UpdateTour $useCase;
    private UpdateTourCommandHandler $handler;
    private $tourRepository;
    private $propertyRepository;
    private Tour $tour;
    private Property $property;

    protected function setUp(): void
    {
        $this->tourRepository = TourInMemoryRepository::empty();
        $this->propertyRepository = PropertyInMemoryRepository::empty();

        $this->useCase = new UpdateTour($this->tourRepository, $this->propertyRepository);
        $this->handler = new UpdateTourCommandHandler($this->useCase);

        $this->property = PropertyStub::random();
        $this->propertyRepository->save($this->property);

        $this->tour = TourStub::create(
            TourIdStub::random(),
            $this->property,
            true
        );


        parent::setUp();
    }

    public function test_should_update_tour_when_exist(): void
    {
        $this->tourRepository->save($this->tour);

        $tourUpdate = TourStub::create(
            $this->tour->id(),
            $this->property,
            true,
        );

        $propertyChange = PropertyStub::random();
        $this->propertyRepository->save($propertyChange);

        $commandUpdate =  new UpdateTourCommand(
            (string)$this->tour->id(),
            (string)$propertyChange->id(),
            (string)$tourUpdate->active(),
        );


        $tourFind = $this->tourRepository->find($this->tour->id());

        /** Before the change. */
        $this->assertEquals($tourFind->property()->id(), $tourUpdate->property()->id());

        $this->useCase->__invoke($commandUpdate);

        /** After the change. */
        $this->assertNotEquals($tourFind->property()->id(), $propertyChange->id());
        $this->assertEquals($tourFind->id(), $tourUpdate->id());
    }

    public function test_should_update_tour_when_not_exist(): void
    {

        $this->expectException(TourNotFoundException::class);

        $commandUpdate =  new UpdateTourCommand(
            (string)TourIdStub::random(),
            (string)PropertyIdStub::random(),
            (string)'1',
        );

        $this->handler->__invoke($commandUpdate);

    }

    public function test_should_update_tour_when_property_not_exist(): void
    {

        $this->expectException(PropertyNotFoundException::class);

        $propertyChangeNotSave = PropertyStub::random();

        $tour = TourStub::create(
            TourIdStub::random(),
            $propertyChangeNotSave,
            true
        );
        $this->tourRepository->save($tour);

        $commandUpdate =  new UpdateTourCommand(
            (string)$tour->id(),
            (string)$tour->property()->id(),
            (string)$tour->active(),
        );

        $this->handler->__invoke($commandUpdate);

    }

}