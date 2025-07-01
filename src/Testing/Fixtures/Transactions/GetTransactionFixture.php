<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Transactions;

use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Models\DedicationResponse;
use Givebutter\Responses\Models\GivingSpaceResponse;
use Givebutter\Responses\Models\LineItemResponse;
use Givebutter\Responses\Models\TransactionResponse;
use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Givebutter\Testing\Fixtures\Models\CustomFieldFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 * @phpstan-import-type DedicationResponseSchema from DedicationResponse
 * @phpstan-import-type GivingSpaceResponseSchema from GivingSpaceResponse
 * @phpstan-import-type LineItemResponseSchema from LineItemResponse
 * @phpstan-import-type TransactionResponseSchema from TransactionResponse
 * @phpstan-import-type GetTransactionResponseSchema from GetTransactionResponse
 */
final class GetTransactionFixture extends AbstractDataFixture
{
    use HasAddressFixtureData, HasErrorData;

    public static function data(): array
    {
        /** @var GetTransactionResponseSchema $data */
        $data = [
            'id' => fake()->text(),
            'number' => fake()->text(),
            'campaign_id' => fake()->numberBetween(),
            'campaign_code' => fake()->text(),
            'plan_id' => fake()->text(),
            'pledge_id' => fake()->text(),
            'team_id' => fake()->text(),
            'member_id' => fake()->text(),
            'fund_id' => fake()->text(),
            'fund_code' => fake()->text(),
            'contact_id' => fake()->numberBetween(1, 100),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company_name' => fake()->company(),
            'company' => fake()->company(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => self::address(),
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
            'giving_space' => self::givingSpace(),
            'dedication' => self::dedication(),
            'transactions' => array_map(static fn (): array => self::transaction(), range(1, fake()->numberBetween(1, 10))), // TODO
            'custom_fields' => array_map(static fn (): array => CustomFieldFixture::data(), range(1, 5)),
            'utm_parameters' => [
                fake()->text() => fake()->text(),
            ],
            'external_id' => fake()->text(),
            'communication_opt_in' => fake()->boolean(),
            'session_id' => fake()->text(),
            'attribution_data' => array_map(static fn (): array => [
                fake()->text() => fake()->text(),
            ], range(1, fake()->numberBetween(1, 5))),
            'fair_market_value_amount' => fake()->numberBetween(),
            'tax_deductible_amount' => fake()->numberBetween(),
        ];

        return $data;
    }

    /**
     * @return GivingSpaceResponseSchema
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
     * @return DedicationResponseSchema
     */
    private static function dedication(): array
    {
        return [
            'type' => fake()->text(),
            'name' => fake()->text(),
            'recipient' => [
                'name' => fake()->name(),
                'email' => fake()->email(),
            ],
        ];
    }

    /**
     * @return TransactionResponseSchema
     */
    private static function transaction(): array
    {
        /** @var TransactionResponseSchema $data */
        $data = [
            'id' => fake()->text(),
            'plan_id' => fake()->text(),
            'pledge_id' => fake()->text(),
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
