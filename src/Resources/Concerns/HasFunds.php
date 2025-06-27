<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Resources\FundsResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasFunds
{
    public function funds(): FundsResourceContract
    {
        return new FundsResource($this->connector);
    }
}
