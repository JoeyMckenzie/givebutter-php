<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type LinksResponseSchema array{
 *     first: string,
 *     last: string,
 *     prev: ?string,
 *     next: ?string,
 * }
 *
 * @implements ResponseContract<LinksResponseSchema>
 */
final readonly class LinksResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<LinksResponseSchema>
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
     * @param  LinksResponseSchema  $attributes
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
