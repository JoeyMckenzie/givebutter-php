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
 *     plan_id: string,
 *     amount: int,
 *     fee: int,
 *     fee_covered: int,
 *     donated: int,
 *     payout: int,
 *     captured: bool,
 *     captured_at: string,
 *     refunded: bool,
 *     line_items: LineItemSchema[]
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
        public string $planId,
        public int $amount,
        public int $fee,
        public int $feeCovered,
        public int $donated,
        public int $payout,
        public bool $captured,
        public CarbonImmutable $capturedAt,
        public bool $refunded,
        public array $lineItems
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
            $attributes['amount'],
            $attributes['fee'],
            $attributes['fee_covered'],
            $attributes['donated'],
            $attributes['payout'],
            $attributes['captured'],
            CarbonImmutable::parse($attributes['captured_at']),
            $attributes['refunded'],
            array_map(fn (array $item): LineItem => LineItem::from($item), $attributes['line_items']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'plan_id' => $this->planId,
            'amount' => $this->amount,
            'fee' => $this->fee,
            'fee_covered' => $this->feeCovered,
            'donated' => $this->donated,
            'payout' => $this->payout,
            'captured' => $this->captured,
            'captured_at' => $this->capturedAt->toIso8601String(),
            'refunded' => $this->refunded,
            'line_items' => array_map(fn (LineItem $item): array => $item->toArray(), $this->lineItems),
        ];
    }
}
