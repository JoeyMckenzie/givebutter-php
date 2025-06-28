<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type StatsSchema array{
 *     recurring_contributions: int,
 *     total_contributions: int
 * }
 *
 * @implements ResponseContract<StatsSchema>
 */
final readonly class Stats implements ResponseContract
{
    /**
     * @use ArrayAccessible<StatsSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public int $recurringContributions,
        public int $totalContributions,
    ) {
        //
    }

    /**
     * @param  StatsSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['recurring_contributions'],
            $attributes['total_contributions'],
        );
    }

    public function toArray(): array
    {
        return [
            'recurring_contributions' => $this->recurringContributions,
            'total_contributions' => $this->totalContributions,
        ];
    }
}
