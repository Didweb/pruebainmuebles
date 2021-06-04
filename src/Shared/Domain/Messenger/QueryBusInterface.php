<?php

declare(strict_types=1);

namespace ApiInmuebles\Shared\Domain\Messenger;

use ApiInmuebles\Shared\Domain\Messenger\Query\Query;

interface QueryBusInterface
{
    /**
     * @psalm-suppress MissingReturnType
     * @phpstan-ignore-next-line
     */
    public function dispatch(Query $query);
}