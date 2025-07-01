<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Responses\Funds\GetFundsResponse;
use Wrapkit\Contracts\ResourceContract;

interface FundsResourceContract extends ResourceContract
{
    public function get(string $id): GetFundResponse;

    public function list(): GetFundsResponse;
}
