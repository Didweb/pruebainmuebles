<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Application\Command;


use ApiInmuebles\Backoffice\Commercial\Tour\Application\Services\UpdateTour;

final class UpdateTourCommandHandler
{
    private UpdateTour $updateTour;

    public function __construct(UpdateTour $updateTour)
    {
        $this->updateTour = $updateTour;
    }

    public function __invoke(UpdateTourCommand $command): void
    {
        $this->updateTour->__invoke($command);
    }

}