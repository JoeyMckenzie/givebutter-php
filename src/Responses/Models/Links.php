<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type LinksSchema array{
 *     first: string,
 *     last: string,
 *     prev: ?string,
 *     next: ?string,
 * }
 *
 * @implements ResponseContract<LinksSchema>
 */
final readonly class Links implements ResponseContract
{
    /**
     * @use ArrayAccessible<LinksSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public string $first,
        public string $last,
        public ?string $prev,
        public ?string $next,
    ) {
        //
    }

    /**
     * @param  LinksSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['first'],
            $attributes['last'],
            $attributes['prev'] ?? null,
            $attributes['next'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'first' => $this->first,
            'last' => $this->last,
            'prev' => $this->prev,
            'next' => $this->next,
        ];
    }
}
