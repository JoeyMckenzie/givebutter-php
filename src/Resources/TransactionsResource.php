<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class TransactionsResource implements TransactionsResourceContract
{
    public string $resource {
        get {
            return 'transactions';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
