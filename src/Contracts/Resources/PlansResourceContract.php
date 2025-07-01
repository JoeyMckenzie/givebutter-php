<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Plans\GetPlanResponse;
use Givebutter\Responses\Plans\GetPlansResponse;
use Wrapkit\Contracts\ResourceContract;

interface PlansResourceContract extends ResourceContract
{
    public function get(string $id): GetPlanResponse;

    public function list(): GetPlansResponse;
}
