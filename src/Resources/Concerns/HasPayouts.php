<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Resources\PayoutsResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasPayouts
{
    public function payouts(): PayoutsResourceContract
    {
        return new PayoutsResource($this->connector);
    }
}
