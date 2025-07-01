<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\CoverResponse;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type CoverResponseSchema from CoverResponse
 */
final class CoverFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var CoverResponseSchema $data */
        $data = [
            'type' => fake()->text(),
            'url' => fake()->url(),
            'source' => fake()->text(),
        ];

        return $data;
    }
}
