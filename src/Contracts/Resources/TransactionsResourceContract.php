<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Wrapkit\Contracts\ResourceContract;

interface TransactionsResourceContract extends ResourceContract
{
    public function list(?string $scope = null): GetTransactionsResponse;

    public function get(string $id): GetTransactionResponse;
}
