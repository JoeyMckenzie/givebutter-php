<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Transactions;

use Carbon\CarbonImmutable;
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
            'id' => 'txn_12345',
            'number' => 'TXN-12345',
            'campaign_id' => 42,
            'campaign_code' => 'CAMP-42',
            'plan_id' => 'plan_67890',
            'pledge_id' => 'pledge_54321',
            'team_id' => 'team_98765',
            'member_id' => 'member_24680',
            'fund_id' => 'fund_13579',
            'fund_code' => 'FUND-13579',
            'contact_id' => 42,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_name' => 'Acme Inc',
            'company' => 'Acme Inc',
            'email' => 'john.doe@example.com',
            'phone' => '555-123-4567',
            'address' => self::address(),
            'status' => 'completed',
            'payment_method' => 'credit_card',
            'method' => 'online',
            'amount' => 50,
            'fee' => 2,
            'fee_covered' => 2,
            'donated' => 50,
            'payout' => 48,
            'currency' => 'USD',
            'transacted_at' => CarbonImmutable::now()->toDateTimeString(),
            'created_at' => CarbonImmutable::now()->toDateTimeString(),
            'timezone' => 'America/New_York',
            'giving_space' => self::givingSpace(),
            'dedication' => self::dedication(),
            'transactions' => [self::transaction(), self::transaction()],
            'custom_fields' => array_map(static fn (): array => CustomFieldFixture::data(), range(1, 5)),
            'utm_parameters' => [
                'utm_source' => 'email',
                'utm_medium' => 'newsletter',
                'utm_campaign' => 'spring_fundraiser',
            ],
            'external_id' => 'ext_12345',
            'communication_opt_in' => true,
            'session_id' => 'sess_67890',
            'attribution_data' => [
                ['referrer' => 'website'],
                ['campaign' => 'email_blast'],
            ],
            'fair_market_value_amount' => 45,
            'tax_deductible_amount' => 40,
        ];

        return $data;
    }

    /**
     * @return GivingSpaceResponseSchema
     */
    private static function givingSpace(): array
    {
        return [
            'id' => 42,
            'name' => 'Community Fund',
            'amount' => 25,
            'message' => 'Supporting our local community',
        ];
    }

    /**
     * @return DedicationResponseSchema
     */
    private static function dedication(): array
    {
        return [
            'type' => 'memorial',
            'name' => 'In memory of Jane Smith',
            'recipient' => [
                'name' => 'Robert Smith',
                'email' => 'robert.smith@example.com',
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
            'id' => 'txn_sub_12345',
            'plan_id' => 'plan_sub_67890',
            'pledge_id' => 'pledge_sub_54321',
            'amount' => 25,
            'fee' => 1,
            'fee_covered' => 1,
            'donated' => 25,
            'payout' => 24,
            'captured' => true,
            'captured_at' => CarbonImmutable::now()->toDateTimeString(),
            'timezone' => 'America/New_York',
            'refunded' => false,
            'refunded_at' => null,
            'line_items' => [
                [
                    'type' => 'donation',
                    'subtype' => 'one-time',
                    'description' => 'One-time donation',
                    'quantity' => 1,
                    'price' => 25,
                    'discount' => 0,
                    'total' => 25,
                ],
                [
                    'type' => 'fee',
                    'subtype' => 'processing',
                    'description' => 'Processing fee',
                    'quantity' => 1,
                    'price' => 1,
                    'discount' => 0,
                    'total' => 1,
                ],
            ],
            'fair_market_value_amount' => 20,
            'tax_deductible_amount' => 20,
        ];

        return $data;
    }
}
