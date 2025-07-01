<?php

declare(strict_types=1);

namespace Givebutter\Responses\Transactions;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Models\CustomFieldResponse;
use Givebutter\Responses\Models\DedicationResponse;
use Givebutter\Responses\Models\GivingSpaceResponse;
use Givebutter\Responses\Models\TransactionResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 * @phpstan-import-type CustomFieldResponseSchema from CustomFieldResponse
 * @phpstan-import-type DedicationResponseSchema from DedicationResponse
 * @phpstan-import-type GivingSpaceResponseSchema from GivingSpaceResponse
 * @phpstan-import-type TransactionResponseSchema from TransactionResponse
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
 *     contact_id: int,
 *     first_name: string,
 *     last_name: string,
 *     company_name: ?string,
 *     company: ?string,
 *     email: ?string,
 *     phone: ?string,
 *     address: ?AddressResponseSchema,
 *     status: string,
 *     payment_method: string,
 *     method: string,
 *     amount: int,
 *     fee: int,
 *     fee_covered: int,
 *     donated: int,
 *     payout: int,
 *     currency: string,
 *     transacted_at: string,
 *     created_at: string,
 *     timezone: string,
 *     giving_space: ?GivingSpaceResponseSchema,
 *     dedication: ?DedicationResponseSchema,
 *     transactions: TransactionResponseSchema[],
 *     custom_fields: CustomFieldResponseSchema[],
 *     utm_parameters: mixed,
 *     external_id: ?string,
 *     communication_opt_in: bool,
 *     session_id: ?string,
 *     attribution_data: ?array<int, array<string, mixed>>,
 *     fair_market_value_amount: ?int,
 *     tax_deductible_amount: ?int
 * }
 *
 * @implements ResponseContract<GetTransactionResponseSchema>
 */
final readonly class GetTransactionResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetTransactionResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetTransactionResponseSchema>
     */
    use Fakeable;

    /**
     * @param  TransactionResponse[]  $transactions
     * @param  CustomFieldResponse[]  $customFields
     * @param  array<int, array<string, mixed>>  $attributionData
     */
    public function __construct(
        public string $id,
        public string $number,
        public int $campaignId,
        public string $campaignCode,
        public ?string $planId,
        public ?string $pledgeId,
        public ?string $teamId,
        public ?string $memberId,
        public ?string $fundId,
        public ?string $fundCode,
        public int $contactId,
        public string $firstName,
        public string $lastName,
        public ?string $companyName,
        public ?string $company,
        public ?string $email,
        public ?string $phone,
        public ?AddressResponse $address,
        public string $status,
        public string $paymentMethod,
        public string $method,
        public int $amount,
        public int $fee,
        public int $feeCovered,
        public int $donated,
        public int $payout,
        public string $currency,
        public CarbonImmutable $transactedAt,
        public CarbonImmutable $createdAt,
        public string $timezone,
        public ?GivingSpaceResponse $givingSpace,
        public ?DedicationResponse $dedication,
        public array $transactions,
        public array $customFields,
        public mixed $utmParameters, // TODO: No documentation for this type, so leave as mixed for now
        public ?string $externalId,
        public bool $communicationOptIn,
        public ?string $sessionId,
        public ?array $attributionData, // TODO: No documentation for array type, leaving as generic array for now
        public ?int $fairMarketValueAmount,
        public ?int $taxDeductibleAmount,
    ) {
        //
    }

    /**
     * @param  GetTransactionResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['number'],
            $attributes['campaign_id'],
            $attributes['campaign_code'],
            $attributes['plan_id'],
            $attributes['pledge_id'],
            $attributes['team_id'],
            $attributes['member_id'],
            $attributes['fund_id'],
            $attributes['fund_code'],
            $attributes['contact_id'],
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['company_name'],
            $attributes['company'],
            $attributes['email'],
            $attributes['phone'],
            isset($attributes['address']) ? AddressResponse::from($attributes['address']) : null,
            $attributes['status'],
            $attributes['payment_method'],
            $attributes['method'],
            $attributes['amount'],
            $attributes['fee'],
            $attributes['fee_covered'],
            $attributes['donated'],
            $attributes['payout'],
            $attributes['currency'],
            CarbonImmutable::parse($attributes['transacted_at']),
            CarbonImmutable::parse($attributes['created_at']),
            $attributes['timezone'],
            isset($attributes['giving_space']) ? GivingSpaceResponse::from($attributes['giving_space']) : null,
            isset($attributes['dedication']) ? DedicationResponse::from($attributes['dedication']) : null,
            array_map(fn (array $transaction): TransactionResponse => TransactionResponse::from($transaction), $attributes['transactions']),
            array_map(static fn (array $field): CustomFieldResponse => CustomFieldResponse::from($field), $attributes['custom_fields']),
            $attributes['utm_parameters'],
            $attributes['external_id'],
            $attributes['communication_opt_in'],
            $attributes['session_id'],
            $attributes['attribution_data'],
            $attributes['fair_market_value_amount'],
            $attributes['tax_deductible_amount'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'campaign_id' => $this->campaignId,
            'campaign_code' => $this->campaignCode,
            'plan_id' => $this->planId,
            'pledge_id' => $this->pledgeId,
            'team_id' => $this->teamId,
            'member_id' => $this->memberId,
            'fund_id' => $this->fundId,
            'fund_code' => $this->fundCode,
            'contact_id' => $this->contactId,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'company_name' => $this->companyName,
            'company' => $this->company,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address?->toArray(),
            'status' => $this->status,
            'payment_method' => $this->paymentMethod,
            'method' => $this->method,
            'amount' => $this->amount,
            'fee' => $this->fee,
            'fee_covered' => $this->feeCovered,
            'donated' => $this->donated,
            'payout' => $this->payout,
            'currency' => $this->currency,
            'transacted_at' => $this->transactedAt->toIso8601String(),
            'created_at' => $this->createdAt->toIso8601String(),
            'timezone' => $this->timezone,
            'giving_space' => $this->givingSpace?->toArray(),
            'dedication' => $this->dedication?->toArray(),
            'transactions' => array_map(static fn (TransactionResponse $transaction): array => $transaction->toArray(), $this->transactions), // @pest-mutate-ignore
            'custom_fields' => array_map(static fn (CustomFieldResponse $field): array => $field->toArray(), $this->customFields), // @pest-mutate-ignore
            'utm_parameters' => $this->utmParameters,
            'external_id' => $this->externalId,
            'communication_opt_in' => $this->communicationOptIn,
            'session_id' => $this->sessionId,
            'attribution_data' => $this->attributionData,
            'fair_market_value_amount' => $this->fairMarketValueAmount,
            'tax_deductible_amount' => $this->taxDeductibleAmount,
        ];
    }
}
