<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\Livestream;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type LivestreamSchema from Livestream
 */
final class LivestreamFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var LivestreamSchema $data */
        $data = [
            'url' => fake()->url(),
            'type' => fake()->text(),
            'location' => fake()->text(),
            'platform' => fake()->text(),
            'embed_url' => fake()->text(),
            'scheduled' => fake()->boolean(),
        ];

        return $data;
    }
}
