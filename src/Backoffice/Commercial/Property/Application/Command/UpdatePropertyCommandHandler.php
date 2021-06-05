<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Property\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Property\Application\Services\UpdateProperty;

final class UpdatePropertyCommandHandler
{
    private UpdateProperty $updateProperty;

    public function __construct(UpdateProperty $updateProperty)
    {
        $this->updateProperty = $updateProperty;
    }

    public function __invoke(UpdatePropertyCommand $command): void
    {
        $this->updateProperty->__invoke($command);
    }
}