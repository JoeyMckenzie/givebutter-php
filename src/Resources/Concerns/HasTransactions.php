<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Givebutter\Resources\TransactionsResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasTransactions
{
    public function transactions(): TransactionsResourceContract
    {
        return new TransactionsResource($this->connector);
    }
}
