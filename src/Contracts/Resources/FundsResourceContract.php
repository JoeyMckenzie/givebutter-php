<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Responses\Funds\GetFundsResponse;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Contracts\ResourceContract;

interface FundsResourceContract extends ResourceContract
{
    public function get(string $id): GetFundResponse;

    public function list(): GetFundsResponse;

    public function create(string $name, ?string $code = null): GetFundResponse;

    public function update(string $id, string $name, ?string $code = null): GetFundResponse;

    public function delete(string $id): ResponseInterface;
}
