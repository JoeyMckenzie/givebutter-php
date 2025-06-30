<?php

declare(strict_types=1);

namespace Givebutter\Responses\Transactions;

use Givebutter\Responses\Models\Address;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type AddressSchema from Address
 *
 * @phpstan-type GetTransactionResponseSchema array{
 *     id: string,
 *     number: string,
 *     campaign_id: int,
 *     campaign_code: string,
 *     plan_id: ?string,
 *     pledge_id: ?string,
 *     team_id: ?string,
 *     member_id: ?string,
 *     fund_id: ?string,
 *     fund_code: ?string,
 *     first_name: string,
 *     last_name: string,
 *     email: string,
 *     phone: string,
 *     address: Address,
 * }
 */
final readonly class GetTransactionResponse implements ResponseContract
{
    use ArrayAccessible;

    public function toArray(): array
    {
        return [];
    }
}
