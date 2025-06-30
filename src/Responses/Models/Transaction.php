<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Carbon\CarbonImmutable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type LineItemSchema from LineItem
 *
 * @phpstan-type TransactionSchema array{
 *     id: string,
 *     plan_id: ?string,
 *     pledge_id: ?string,
 *     amount: int,
 *     fee: int,
 *     fee_covered: int,
 *     donated: int,
 *     payout: int,
 *     captured: bool,
 *     captured_at: ?string,
 *     timezone: string,
 *     refunded: bool,
 *     refunded_at: ?string,
 *     line_items: LineItemSchema[],
 *     fair_market_value_amount: ?int,
 *     tax_deductible_amount: ?int
 * }
 *
 * @implements ResponseContract<TransactionSchema>
 */
final readonly class Transaction implements ResponseContract
{
    /**
     * @use ArrayAccessible<TransactionSchema>
     */
    use ArrayAccessible;

    /**
     * @param  LineItem[]  $lineItems
     */
    public function __construct(
        public string $id,
        public ?string $planId,
        public ?string $pledgeId,
        public int $amount,
        public int $fee,
        public int $feeCovered,
        public int $donated,
        public int $payout,
        public bool $captured,
        public ?CarbonImmutable $capturedAt,
        public string $timezone,
        public bool $refunded,
        public ?CarbonImmutable $refundedAt,
        public array $lineItems,
        public ?int $fairMarketValueAmount,
        public ?int $taxDeductibleAmount,
    ) {
        //
    }

    /**
     * @param  TransactionSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['plan_id'],
            $attributes['pledge_id'],
            $attributes['amount'],
            $attributes['fee'],
            $attributes['fee_covered'],
            $attributes['donated'],
            $attributes['payout'],
            $attributes['captured'],
            isset($attributes['captured_at']) ? CarbonImmutable::parse($attributes['captured_at']) : null,
            $attributes['timezone'],
            $attributes['refunded'],
            isset($attributes['refunded_at']) ? CarbonImmutable::parse($attributes['refunded_at']) : null,
            array_map(fn (array $item): LineItem => LineItem::from($item), $attributes['line_items']),
            $attributes['fair_market_value_amount'],
            $attributes['tax_deductible_amount'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'plan_id' => $this->planId,
            'pledge_id' => $this->pledgeId,
            'amount' => $this->amount,
            'fee' => $this->fee,
            'fee_covered' => $this->feeCovered,
            'donated' => $this->donated,
            'payout' => $this->payout,
            'captured' => $this->captured,
            'captured_at' => $this->capturedAt?->toIso8601String(),
            'timezone' => $this->timezone,
            'refunded' => $this->refunded,
            'refunded_at' => $this->refundedAt?->toIso8601String(),
            'line_items' => array_map(fn (LineItem $item): array => $item->toArray(), $this->lineItems),
            'fair_market_value_amount' => $this->fairMarketValueAmount,
            'tax_deductible_amount' => $this->taxDeductibleAmount,
        ];
    }
}
