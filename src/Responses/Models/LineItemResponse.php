<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type LineItemResponseSchema array{
 *     type: string,
 *     subtype: string,
 *     description: string,
 *     quantity: int,
 *     price: int,
 *     discount: int,
 *     total: int,
 * }
 *
 * @implements ResponseContract<LineItemResponseSchema>
 */
final readonly class LineItemResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<LineItemResponseSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public string $type,
        public string $subtype,
        public string $description,
        public int $quantity,
        public int $price,
        public int $discount,
        public int $total,
    ) {
        //
    }

    /**
     * @param  LineItemResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['subtype'],
            $attributes['description'],
            $attributes['quantity'],
            $attributes['price'],
            $attributes['discount'],
            $attributes['total'],
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'subtype' => $this->subtype,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'total' => $this->total,
        ];
    }
}
