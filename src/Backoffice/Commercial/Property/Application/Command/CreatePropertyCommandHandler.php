<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Services\CreateProperty;

final class CreatePropertyCommandHandler
{
    private CreateProperty $createProperty;

    public function __construct(CreateProperty $createProperty)
    {
        $this->createProperty = $createProperty;
    }

    public function __invoke(CreatePropertyCommand $command): void
    {

        $this->createProperty->__invoke($command);
    }

}