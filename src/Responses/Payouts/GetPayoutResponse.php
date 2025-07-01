<?php

declare(strict_types=1);

namespace Givebutter\Responses\Payouts;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Concerns\HasErrorMessaging;
use Givebutter\Responses\Models\AddressResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 *
 * @phpstan-type GetPayoutResponseSchema array{
 *     id?: ?string,
 *     campaign_id?: ?int,
 *     method?: ?string,
 *     status?: ?string,
 *     amount?: ?int,
 *     fee?: ?int,
 *     tip?: ?int,
 *     payout?: ?int,
 *     currency?: ?string,
 *     address?: ?AddressResponseSchema,
 *     memo?: ?string,
 *     completed_at?: ?string,
 *     created_at?: ?string,
 *     message?: ?string,
 * }
 *
 * @implements ResponseContract<GetPayoutResponseSchema>
 */
final readonly class GetPayoutResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetPayoutResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetPayoutResponseSchema>
     */
    use Fakeable;

    use HasErrorMessaging;

    public function __construct(
        public ?string $id,
        public ?int $campaignId,
        public ?string $method,
        public ?string $status,
        public ?int $amount,
        public ?int $fee,
        public ?int $tip,
        public ?int $payout,
        public ?string $currency,
        public ?AddressResponse $address,
        public ?string $memo,
        public ?CarbonImmutable $completedAt,
        public ?CarbonImmutable $createdAt,
        public ?string $message
    ) {
        //
    }

    /**
     * @param  GetPayoutResponseSchema  $attributes
     */
    public static function from(array $attributes): static
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['campaign_id'] ?? null,
            $attributes['method'] ?? null,
            $attributes['status'] ?? null,
            $attributes['amount'] ?? null,
            $attributes['fee'] ?? null,
            $attributes['tip'] ?? null,
            $attributes['payout'] ?? null,
            $attributes['currency'] ?? null,
            isset($attributes['address']) ? AddressResponse::from($attributes['address']) : null,
            $attributes['memo'] ?? null,
            isset($attributes['completed_at']) ? CarbonImmutable::parse($attributes['completed_at']) : null,
            isset($attributes['created_at']) ? CarbonImmutable::parse($attributes['created_at']) : null,
            $attributes['message'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'campaign_id' => $this->campaignId,
            'method' => $this->method,
            'status' => $this->status,
            'amount' => $this->amount,
            'fee' => $this->fee,
            'tip' => $this->tip,
            'payout' => $this->payout,
            'currency' => $this->currency,
            'address' => $this->address?->toArray(),
            'memo' => $this->memo,
            'completed_at' => $this->completedAt?->toIso8601String(),
            'created_at' => $this->createdAt?->toIso8601String(),
            'message' => $this->message,
        ];
    }
}
