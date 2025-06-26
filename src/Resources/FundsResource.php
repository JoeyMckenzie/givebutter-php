<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\FundsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class FundsResource implements FundsResourceContract
{
    public string $resource {
        get {
            return 'funds';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
