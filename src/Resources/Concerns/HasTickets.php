<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Resources\TicketsResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasTickets
{
    public function tickets(): TicketsResourceContract
    {
        return new TicketsResource($this->connector);
    }
}
