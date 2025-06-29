<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Resources\TicketsResource;
use Givebutter\Responses\Tickets\GetTicketResponse;
use Givebutter\Responses\Tickets\GetTicketsResponse;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetTicketResponseSchema from GetTicketResponse
 * @phpstan-import-type GetTicketsResponseSchema from GetTicketsResponse
 *
 * @phpstan-type TicketsResponseSchema GetTicketResponseSchema|GetTicketsResponseSchema
 */
final class TicketsTestResource implements TicketsResourceContract
{
    /**
     * @use Testable<TicketsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return TicketsResource::class;
        }
    }

    public function get(string $id): GetTicketResponse
    {
        /** @var GetTicketResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(): GetTicketsResponse
    {
        /** @var GetTicketsResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
