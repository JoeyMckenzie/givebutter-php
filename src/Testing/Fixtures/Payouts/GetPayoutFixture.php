<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Payouts;

use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type GetPayoutResponseSchema from GetPayoutResponse
 */
final class GetPayoutFixture extends AbstractDataFixture
{
    use HasAddressFixtureData;

    public static function data(): array
    {
        /** @var GetPayoutResponseSchema $data */
        $data = [
            'id' => fake()->text(),
            'campaign_id' => fake()->numberBetween(),
            'method' => fake()->randomElement(['check', 'bank']),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled', 'failed']),
            'amount' => fake()->numberBetween(1, 100),
            'fee' => fake()->numberBetween(1, 100),
            'tip' => fake()->numberBetween(1, 100),
            'payout' => fake()->numberBetween(1, 100),
            'currency' => 'USD',
            'address' => fake()->boolean() ? self::address() : null,
            'memo' => fake()->boolean() ? fake()->text() : null,
            'completed_at' => fake()->boolean() ? fake()->iso8601() : null,
            'created_at' => fake()->iso8601(),
        ];

        return $data;
    }
}
