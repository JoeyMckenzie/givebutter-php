<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Resources\PlansResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasPlans
{
    public function plans(): PlansResourceContract
    {
        return new PlansResource($this->connector);
    }
}
