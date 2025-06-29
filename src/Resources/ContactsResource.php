<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Responses\Contacts\GetContactResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 */
final class ContactsResource implements ContactsResourceContract
{
    public string $resource {
        get {
            return 'contacts';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function get(int $id): GetContactResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetContactResponseSchema $data */
        $data = $response->data();

        return GetContactResponse::from($data);
    }
}
