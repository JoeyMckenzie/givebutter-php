<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetTransactionResponseSchema from GetTransactionResponse
 * @phpstan-import-type GetTransactionsResponseSchema from GetTransactionsResponse
 */
final class TransactionsResource implements TransactionsResourceContract
{
    public string $resource {
        get {
            return 'transactions';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function list(?string $scope = null): GetTransactionsResponse
    {
        $request = ClientRequestBuilder::get($this->resource)
            ->withQueryParam('scope', $scope);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetTransactionsResponseSchema $data */
        $data = $response->data();

        return GetTransactionsResponse::from($data);
    }

    public function get(string $id): GetTransactionResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetTransactionResponseSchema $data */
        $data = $response->data();

        return GetTransactionResponse::from($data);
    }
}
