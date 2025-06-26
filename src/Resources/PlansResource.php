<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\PlansResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class PlansResource implements PlansResourceContract
{
    public string $resource {
        get {
            return 'plans';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
