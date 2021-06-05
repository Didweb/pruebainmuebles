<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Application\Services;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\CreatePropertyCommand;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyRepository;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Shared\Domain\ValueObjects\ToursCollection;

final class CreateProperty
{
    private PropertyRepository $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreatePropertyCommand $command): void
    {

        $property = new Property(
            PropertyId::create($command->id()),
            new PropertyTitle($command->title()),
            new PropertyDescription($command->description())
        );

        $this->repository->save($property);
    }

}