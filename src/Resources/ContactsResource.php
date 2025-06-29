<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Contacts\GetContactsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 * @phpstan-import-type GetContactsResponseSchema from GetContactsResponse
 * @phpstan-import-type CreateContactSchema from ContactsResourceContract
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

    public function list(?string $scope = null): GetContactsResponse
    {
        $request = ClientRequestBuilder::get($this->resource)
            ->withQueryParam('scope', $scope);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetContactsResponseSchema $data */
        $data = $response->data();

        return GetContactsResponse::from($data);
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

    public function create(array $params, bool $forceCreate = false): GetContactResponse
    {
        $request = ClientRequestBuilder::post($this->resource)
            ->withQueryParam('force_create', $forceCreate ? 'true' : 'false')
            ->withRequestContent($params);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetContactResponseSchema $data */
        $data = $response->data();

        return GetContactResponse::from($data);
    }

    public function update(int $id, array $params): GetContactResponse
    {
        $request = ClientRequestBuilder::patch("$this->resource/$id")
            ->withRequestContent($params);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetContactResponseSchema $data */
        $data = $response->data();

        return GetContactResponse::from($data);
    }
}
