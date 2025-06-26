<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type CoverSchema array{
 *     type: string,
 *     url: string,
 *     source: string,
 * }
 *
 * @implements ResponseContract<CoverSchema>
 */
final readonly class Cover implements ResponseContract
{
    /**
     * @use ArrayAccessible<CoverSchema>
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
     * @param  CoverSchema  $attributes
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
