<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Concerns;

use Givebutter\Responses\Models\Error;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type ErrorSchema from Error
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
                'field.0.value' => [
                    fake()->text(),
                ],
                'field.1.value' => [
                    fake()->text(),
                ],
            ],
        ];

        return $data;
    }
}
