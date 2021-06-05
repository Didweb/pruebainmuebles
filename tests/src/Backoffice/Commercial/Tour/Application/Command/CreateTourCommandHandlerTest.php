<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\src\Backoffice\Commercial\Tour\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\CreatePropertyCommand;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\CreatePropertyCommandHandler;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Services\CreateProperty;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\CreateTourCommand;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\CreateTourCommandHandler;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Services\CreateTour;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescriptionStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyIdStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitleStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\TourInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Tour\Domain\valueObjects\TourIdStub;
use PHPUnit\Framework\TestCase;

final class CreateTourCommandHandlerTest extends TestCase
{
    private CreateTour $useCase;
    private CreateTourCommandHandler $handler;
    private $tourRepository;
    private $propertyRepository;
    private CreatePropertyCommand $propertyCommand;

    protected function setUp(): void
    {
        $this->tourRepository = TourInMemoryRepository::empty();
        $this->propertyRepository = PropertyInMemoryRepository::empty();
        $this->useCase = new CreateTour($this->tourRepository, $this->propertyRepository);
        $this->handler = new CreateTourCommandHandler($this->useCase);

        $this->propertyCommand = new CreatePropertyCommand(
            (string)PropertyIdStub::random(),
            (string)PropertyTitleStub::random(),
            (string)PropertyDescriptionStub::random()
        );
        $useCaseProperty = new CreateProperty($this->propertyRepository);
        $handlerProperty = new CreatePropertyCommandHandler($useCaseProperty);
        $handlerProperty->__invoke($this->propertyCommand);


        parent::setUp();
    }

    public function test_should_create_tour(): void
    {
        $property = new Property(
            PropertyIdStub::create($this->propertyCommand->id()),
            new PropertyTitle($this->propertyCommand->title()),
            new PropertyDescription($this->propertyCommand->description())
        );

        $command = new CreateTourCommand(
            (string)TourIdStub::random(),
            (string)$property->id(),
            "1"
        );

        $this->handler->__invoke($command);
        $itemInMemory = $this->tourRepository->find(TourIdStub::create($command->id()));

        $this->assertEquals($command->id(), $itemInMemory->id());
    }

    public function test_should_create_tour_when_property_not_exist(): void
    {
        $this->expectException(PropertyNotFoundException::class);

        $command = new CreateTourCommand(
            (string)TourIdStub::random(),
            (string)PropertyIdStub::random(),
            "1"
        );

        $this->handler->__invoke($command);

    }
}