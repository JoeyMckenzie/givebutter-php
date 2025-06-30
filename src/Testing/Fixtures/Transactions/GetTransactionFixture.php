<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Transactions;

use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Models\Dedication;
use Givebutter\Responses\Models\GivingSpace;
use Givebutter\Responses\Models\LineItem;
use Givebutter\Responses\Models\Transaction;
use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Givebutter\Testing\Fixtures\Models\CustomFieldFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type DedicationSchema from Dedication
 * @phpstan-import-type GivingSpaceSchema from GivingSpace
 * @phpstan-import-type LineItemSchema from LineItem
 * @phpstan-import-type TransactionSchema from Transaction
 * @phpstan-import-type GetTransactionResponseSchema from GetTransactionResponse
 */
final class GetTransactionFixture extends AbstractDataFixture
{
    use HasAddressFixtureData;

    public static function data(): array
    {
        /** @var GetTransactionResponseSchema $data */
        $data = [
            'id' => fake()->text(),
            'number' => fake()->text(),
            'campaign_id' => fake()->numberBetween(),
            'campaign_code' => fake()->text(),
            'plan_id' => fake()->boolean() ? fake()->text() : null,
            'pledge_id' => fake()->boolean() ? fake()->text() : null,
            'team_id' => fake()->boolean() ? fake()->text() : null,
            'member_id' => fake()->boolean() ? fake()->text() : null,
            'fund_id' => fake()->boolean() ? fake()->text() : null,
            'fund_code' => fake()->boolean() ? fake()->text() : null,
            'contact_id' => fake()->numberBetween(1, 100),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company_name' => fake()->boolean() ? fake()->company() : null,
            'company' => fake()->boolean() ? fake()->company() : null,
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->boolean() ? self::address() : null,
            'status' => fake()->text(),
            'payment_method' => fake()->text(),
            'method' => fake()->text(),
            'amount' => fake()->numberBetween(1, 100),
            'fee' => fake()->numberBetween(1, 100),
            'fee_covered' => fake()->numberBetween(1, 100),
            'donated' => fake()->numberBetween(1, 100),
            'payout' => fake()->numberBetween(1, 100),
            'currency' => fake()->text(),
            'transacted_at' => fake()->iso8601(),
            'created_at' => fake()->iso8601(),
            'timezone' => fake()->timezone(),
            'giving_space' => fake()->boolean() ? self::givingSpace() : null,
            'dedication' => fake()->boolean() ? self::dedication() : null,
            'transactions' => array_map(static fn (): array => self::transaction(), range(1, fake()->numberBetween(1, 10))), // TODO
            'custom_fields' => array_map(static fn (): array => CustomFieldFixture::data(), range(1, 5)),
            'utm_parameters' => [
                fake()->text() => fake()->text(),
            ],
            'external_id' => fake()->boolean() ? fake()->text() : null,
            'communication_opt_in' => fake()->boolean(),
            'session_id' => fake()->text(),
            'attribution_data' => array_map(static fn (): array => [
                fake()->text() => fake()->text(),
            ], range(1, fake()->numberBetween(1, 5))),
            'fair_market_value_amount' => fake()->boolean() ? fake()->numberBetween() : null,
            'tax_deductible_amount' => fake()->boolean() ? fake()->numberBetween() : null,
        ];

        return $data;
    }

    /**
     * @return GivingSpaceSchema
     */
    private static function givingSpace(): array
    {
        return [
            'id' => fake()->numberBetween(1, 100),
            'name' => fake()->text(),
            'amount' => fake()->numberBetween(1, 100),
            'message' => fake()->text(),
        ];
    }

    /**
     * @return DedicationSchema
     */
    private static function dedication(): array
    {
        return [
            'type' => fake()->text(),
            'name' => fake()->text(),
            'recipient' => [
                'name' => fake()->boolean() ? fake()->name() : null,
                'email' => fake()->boolean() ? fake()->email() : null,
            ],
        ];
    }

    /**
     * @return TransactionSchema
     */
    private static function transaction(): array
    {
        /** @var TransactionSchema $data */
        $data = [
            'id' => fake()->text(),
            'plan_id' => fake()->boolean() ? fake()->text() : null,
            'pledge_id' => fake()->boolean() ? fake()->text() : null,
            'amount' => fake()->numberBetween(1, 100),
            'fee' => fake()->numberBetween(1, 100),
            'fee_covered' => fake()->numberBetween(1, 100),
            'donated' => fake()->numberBetween(1, 100),
            'payout' => fake()->numberBetween(1, 100),
            'captured' => fake()->boolean(),
            'captured_at' => fake()->iso8601(),
            'timezone' => fake()->timezone(),
            'refunded' => fake()->boolean(),
            'refunded_at' => fake()->iso8601(),
            'line_items' => array_map(static fn (): array => [
                'type' => fake()->text(),
                'subtype' => fake()->text(),
                'description' => fake()->text(),
                'quantity' => fake()->numberBetween(1, 100),
                'price' => fake()->numberBetween(1, 100),
                'discount' => fake()->numberBetween(1, 100),
                'total' => fake()->numberBetween(1, 100),
            ], range(1, fake()->numberBetween(1, 5))),
            'fair_market_value_amount' => fake()->numberBetween(1, 100),
            'tax_deductible_amount' => fake()->numberBetween(1, 100),
        ];

        return $data;
    }
}
