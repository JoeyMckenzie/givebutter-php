<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Givebutter\Resources\TransactionsResource;
use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetTransactionResponseSchema from GetTransactionResponse
 * @phpstan-import-type GetTransactionsResponseSchema from GetTransactionsResponse
 * @phpstan-import-type CreateTransactionResponseSchema from TransactionsResourceContract
 *
 * @phpstan-type TransactionsResponseSchema GetTransactionResponseSchema|GetTransactionsResponseSchema
 */
final class TransactionsTestResource implements TransactionsResourceContract
{
    /**
     * @use Testable<TransactionsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return TransactionsResource::class;
        }
    }

    public function get(string $id): GetTransactionResponse
    {
        /** @var GetTransactionResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(?string $scope = null): GetTransactionsResponse
    {
        /** @var GetTransactionsResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    /**
     * @param  CreateTransactionResponseSchema  $params
     */
    public function create(array $params): GetTransactionResponse
    {
        /** @var GetTransactionResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
