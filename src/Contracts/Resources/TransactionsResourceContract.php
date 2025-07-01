<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Wrapkit\Contracts\ResourceContract;

/**
 * @phpstan-type CreateTransactionResponseSchema array{
 *     campaign_code?: string,
 *     campaign_title?: string,
 *     contact_id?: int,
 *     fund_code?: string,
 *     first_name?: string,
 *     last_name?: string,
 *     email?: string,
 *     phone?: string,
 *     address_1?: string,
 *     address_2?: string,
 *     city?: string,
 *     state?: string,
 *     zipcode?: string,
 *     country?: string,
 *     transacted_at: string,
 *     acknowledged_at?: string,
 *     amount: float,
 *     method: string,
 *     platform_fee?: float,
 *     processing_fee?: float,
 *     fee_covered?: float,
 *     check_number?: string,
 *     check_deposited_at?: string,
 *     external_id?: string,
 *     external_label?: string,
 * }
 */
interface TransactionsResourceContract extends ResourceContract
{
    public function list(?string $scope = null): GetTransactionsResponse;

    public function get(string $id): GetTransactionResponse;

    /**
     * @param  CreateTransactionResponseSchema  $params
     */
    public function create(array $params): GetTransactionResponse;
}
