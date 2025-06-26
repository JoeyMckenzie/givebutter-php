<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\TicketsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class TicketsResource implements TicketsResourceContract
{
    public string $resource {
        get {
            return 'tickets';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
