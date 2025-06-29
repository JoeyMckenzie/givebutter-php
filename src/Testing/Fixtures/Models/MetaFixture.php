<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\Meta;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type MetaSchema from Meta
 */
final class MetaFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var MetaSchema $data */
        $data = [
            'current_page' => 1,
            'from' => 1,
            'last_page' => fake()->numberBetween(2, 100),
            'path' => fake()->url(),
            'per_page' => 20,
            'to' => fake()->numberBetween(1, 100),
            'total' => fake()->numberBetween(1, 100),
            'unfiltered_total' => fake()->numberBetween(1, 100),
            'links' => array_map(
                static fn (): array => [
                    'url' => fake()->url(),
                    'label' => fake()->text(),
                    'active' => fake()->boolean(),
                ],
                range(1, fake()->numberBetween(2, 5))
            ),
        ];

        return $data;
    }
}
