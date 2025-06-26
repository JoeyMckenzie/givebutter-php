<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class PayoutsResource implements PayoutsResourceContract
{
    public string $resource {
        get {
            return 'payouts';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
