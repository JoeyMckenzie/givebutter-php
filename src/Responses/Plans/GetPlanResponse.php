<?php

declare(strict_types=1);

namespace Givebutter\Responses\Plans;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\Address;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetPlanResponseSchema array{
 *     id: string,
 *     first_name: string,
 *     last_name: string,
 *     email: string,
 *     phone: string,
 * }
 *
 * @implements ResponseContract<GetPlanResponseSchema>
 */
final readonly class GetPlanResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetPlanResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetPlanResponseSchema>
     */
    use Fakeable;

    public function __construct(
        public string $id,
        public int $campaignId,
        public string $method,
        public string $status,
        public int $amount,
        public int $fee,
        public int $tip,
        public int $payout,
        public string $currency,
        public ?Address $address,
        public ?string $memo,
        public ?CarbonImmutable $completedAt,
        public CarbonImmutable $createdAt,
    ) {
        //
    }

    /**
     * @param  GetPlanResponseSchema  $attributes
     */
    public static function from(array $attributes): static
    {
        return new self(
            $attributes['id'],
            $attributes['campaign_id'],
            $attributes['method'],
            $attributes['status'],
            $attributes['amount'],
            $attributes['fee'],
            $attributes['tip'],
            $attributes['payout'],
            $attributes['currency'],
            isset($attributes['address']) ? Address::from($attributes['address']) : null,
            $attributes['memo'],
            isset($attributes['completed_at']) ? CarbonImmutable::parse($attributes['completed_at']) : null,
            CarbonImmutable::parse($attributes['created_at']),
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
            'created_at' => $this->createdAt->toIso8601String(),
        ];
    }
}
