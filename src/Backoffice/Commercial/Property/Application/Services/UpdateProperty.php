<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Application\Services;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\UpdatePropertyCommand;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Exceptions\PropertyNotFoundException;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\Property;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyFinder;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\PropertyRepository;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyDescription;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyId;
use ApiInmuebles\Backoffice\Commercial\Property\Domain\ValueObjects\PropertyTitle;
use ApiInmuebles\Shared\Domain\ValueObjects\ToursCollection;
use ApiInmuebles\Shared\Domain\ValueObjects\Uuid;

final class UpdateProperty
{
    private PropertyRepository $repository;
    private PropertyFinder $finder;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new PropertyFinder($repository);
    }

    public function __invoke(UpdatePropertyCommand $command): void
    {

        $property = $this->finder->__invoke(PropertyId::create($command->id()));

        $property->updateProperty($command);

        $this->repository->save($property);
    }
}