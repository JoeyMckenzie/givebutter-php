<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Tickets\GetTicketResponse;
use Givebutter\Responses\Tickets\GetTicketsResponse;
use Wrapkit\Contracts\ResourceContract;

interface TicketsResourceContract extends ResourceContract
{
    public function list(): GetTicketsResponse;

    public function get(string $id): GetTicketResponse;
}
