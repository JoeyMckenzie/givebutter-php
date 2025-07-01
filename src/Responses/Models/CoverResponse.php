<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type CoverResponseSchema array{
 *     type: string,
 *     url: string,
 *     source: string,
 * }
 *
 * @implements ResponseContract<CoverResponseSchema>
 */
final readonly class CoverResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<CoverResponseSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public string $type,
        public string $url,
        public string $source,
    ) {
        //
    }

    /**
     * @param  CoverResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['url'],
            $attributes['source'],
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'url' => $this->url,
            'source' => $this->source,
        ];
    }
}
