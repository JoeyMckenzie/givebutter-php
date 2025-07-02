<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Payouts;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 * @phpstan-import-type GetPayoutResponseSchema from GetPayoutResponse
 */
final class GetPayoutFixture extends AbstractDataFixture
{
    use HasAddressFixtureData, HasErrorData;

    public static function data(): array
    {
        /** @var GetPayoutResponseSchema $data */
        $data = [
            'id' => 'payout_12345',
            'campaign_id' => 42,
            'method' => 'bank',
            'status' => 'completed',
            'amount' => 1000,
            'fee' => 25,
            'tip' => 50,
            'payout' => 975,
            'currency' => 'USD',
            'address' => self::address(),
            'memo' => 'Quarterly payout for fundraising campaign',
            'completed_at' => CarbonImmutable::now()->toIso8601String(),
            'created_at' => CarbonImmutable::now()->toIso8601String(),
        ];

        return $data;
    }
}
