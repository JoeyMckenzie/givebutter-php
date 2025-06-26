<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type LivestreamSchema array{
 *     url: string,
 *     type: string,
 *     location: string,
 *     platform: string,
 *     embed_url: string,
 *     scheduled: bool
 * }
 *
 * @implements ResponseContract<LivestreamSchema>
 */
final class Livestream implements ResponseContract
{
    /**
     * @use ArrayAccessible<LivestreamSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public string $url,
        public string $type,
        public string $location,
        public string $platform,
        public string $embed_url,
        public bool $scheduled
    ) {
        //
    }

    /**
     * @param  LivestreamSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['url'],
            $attributes['type'],
            $attributes['location'],
            $attributes['platform'],
            $attributes['embed_url'],
            $attributes['scheduled']
        );
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'type' => $this->type,
            'location' => $this->location,
            'platform' => $this->platform,
            'embed_url' => $this->embed_url,
            'scheduled' => $this->scheduled,
        ];
    }
}
