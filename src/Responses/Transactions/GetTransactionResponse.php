<?php

declare(strict_types=1);

namespace Givebutter\Responses\Transactions;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

final readonly class GetTransactionResponse implements ResponseContract
{
    use ArrayAccessible;

    public function toArray(): array
    {
        return [];
    }
}
