<?php

declare(strict_types=1);

namespace ApiInmuebles\Tests\src\Backoffice\Commercial\Property\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\CreatePropertyCommand;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\CreatePropertyCommandHandler;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Services\CreateProperty;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\PropertyInMemoryRepository;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescriptionStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyIdStub;
use ApiInmuebles\Tests\Double\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitleStub;
use PHPUnit\Framework\TestCase;

final class CreatePropertyCommandHandlerTest extends TestCase
{
    private CreateProperty $useCase;
    private CreatePropertyCommandHandler $handler;
    private $repository;

    protected function setUp(): void
    {
        $this->repository = PropertyInMemoryRepository::empty();
        $this->useCase = new CreateProperty($this->repository);
        $this->handler = new CreatePropertyCommandHandler($this->useCase);

        parent::setUp();
    }

    public function test_should_create_property(): void
    {
        $command = new CreatePropertyCommand(
            (string)PropertyIdStub::random(),
            (string)PropertyTitleStub::random(),
            (string)PropertyDescriptionStub::random()
        );

        $this->handler->__invoke($command);
        $itemInMemory = $this->repository->find(PropertyIdStub::create($command->id()));

        $this->assertEquals($command->id(), $itemInMemory->id());
    }

}