<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\LivestreamResponse;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type LivestreamResponseSchema from LivestreamResponse
 */
final class LivestreamFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var LivestreamResponseSchema $data */
        $data = [
            'url' => 'https://example.com/livestream/event123',
            'type' => 'video',
            'location' => 'online',
            'platform' => 'zoom',
            'embed_url' => 'https://example.com/embed/livestream/event123',
            'scheduled' => true,
        ];

        return $data;
    }
}
