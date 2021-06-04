<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Domain\Messenger;


use ApiInmuebles\Shared\Domain\Messenger\Command\Command;

interface CommandBusInterface
{
    public function dispatch(Command $command): void;
}