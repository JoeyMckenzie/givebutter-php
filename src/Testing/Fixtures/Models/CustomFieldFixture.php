<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\CustomField;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type CustomFieldSchema from CustomField
 */
final class CustomFieldFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var CustomFieldSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'field_id' => fake()->numberBetween(1, 100),
            'type' => fake()->text(),
            'value' => fake()->text(),
            'title' => fake()->title,
            'description' => fake()->text(),
        ];

        return $data;
    }
}
