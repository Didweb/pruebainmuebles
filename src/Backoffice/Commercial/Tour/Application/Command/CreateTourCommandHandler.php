<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Tour\Application\Services\CreateTour;

final class CreateTourCommandHandler
{
    private CreateTour $createTour;

    public function __construct(CreateTour $createTour)
    {
        $this->createTour = $createTour;
    }

    public function __invoke(CreateTourCommand $command): void
    {
        $this->createTour->__invoke($command);
    }

}