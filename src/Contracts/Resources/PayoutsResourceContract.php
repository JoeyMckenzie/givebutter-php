<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Responses\Payouts\GetPayoutsResponse;
use Wrapkit\Contracts\ResourceContract;

interface PayoutsResourceContract extends ResourceContract
{
    public function list(): GetPayoutsResponse;

    public function get(string $id): GetPayoutResponse;
}
