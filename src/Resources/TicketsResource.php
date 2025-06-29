<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Responses\Tickets\GetTicketResponse;
use Givebutter\Responses\Tickets\GetTicketsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetTicketResponseSchema from GetTicketResponse
 * @phpstan-import-type GetTicketsResponseSchema from GetTicketsResponse
 */
final class TicketsResource implements TicketsResourceContract
{
    public string $resource {
        get {
            return 'tickets';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function list(): GetTicketsResponse
    {
        $request = ClientRequestBuilder::get($this->resource);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetTicketsResponseSchema $data */
        $data = $response->data();

        return GetTicketsResponse::from($data);
    }

    public function get(string $id): GetTicketResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetTicketResponseSchema $data */
        $data = $response->data();

        return GetTicketResponse::from($data);
    }
}
