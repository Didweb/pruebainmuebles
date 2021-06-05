<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\src\Backoffice\Commercial\Property\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\UpdatePropertyCommand;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\UpdatePropertyCommandHandler;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Services\UpdateProperty;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescriptionStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitleStub;
use PHPUnit\Framework\TestCase;

final class UpdatePropertyCommandHandlerTest extends TestCase
{
    private UpdateProperty $useCase;
    private UpdatePropertyCommandHandler $handler;
    private $repository;
    private Property $property;

    protected function setUp(): void
    {
        $this->repository = PropertyInMemoryRepository::empty();
        $this->useCase = new UpdateProperty($this->repository);
        $this->handler = new UpdatePropertyCommandHandler($this->useCase);

        $this->property = PropertyStub::random();


        parent::setUp();
    }

    public function test_should_update_property_when_exist(): void
    {
        $this->repository->save($this->property);

        $propertyUpdate = PropertyStub::create(
            $this->property->id(),
            PropertyTitleStub::create('New Title'),
            PropertyDescriptionStub::create('New Description'),
        );
        $commandUpdate =  new UpdatePropertyCommand(
            (string)$this->property->id(),
            'New Title',
            'New Description',
        );


        $propertyFind = $this->repository->find($this->property->id());

        /** Before the change. */
        $this->assertNotEquals($propertyFind->title(), $propertyUpdate->title());

        $this->useCase->__invoke($commandUpdate);

        /** After the change. */
        $this->assertEquals($propertyFind->title(), $propertyUpdate->title());
    }
}