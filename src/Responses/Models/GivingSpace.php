<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type GivingSpaceSchema array{
 *     id: int,
 *     name: string,
 *     amount: int,
 *     message: string,
 * }
 *
 * @implements ResponseContract<GivingSpaceSchema>
 */
final readonly class GivingSpace implements ResponseContract
{
    /**
     * @use ArrayAccessible<GivingSpaceSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public int $id,
        public string $name,
        public int $amount,
        public string $message
    ) {
        //
    }

    /**
     * @param  GivingSpaceSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['name'],
            $attributes['amount'],
            $attributes['message']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'message' => $this->message,
        ];
    }
}
