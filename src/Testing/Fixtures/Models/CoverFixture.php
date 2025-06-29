<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\Cover;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type CoverSchema from Cover
 */
final class CoverFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var CoverSchema $data */
        $data = [
            'type' => fake()->text(),
            'url' => fake()->url(),
            'source' => fake()->text(),
        ];

        return $data;
    }
}
