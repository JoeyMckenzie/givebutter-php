<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Concerns;

use Givebutter\Responses\Models\Errors;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type ErrorSchema from Errors
 */
trait HasErrorData
{
    /**
     * @return ErrorSchema
     */
    public static function errors(): array
    {
        /** @var ErrorSchema $data */
        $data = [
            'message' => fake()->text(),
            'errors' => [
                'field.0' => [
                    fake()->text(),
                ],
                'field.1' => [
                    fake()->text(),
                ],
            ],
        ];

        return $data;
    }
}
