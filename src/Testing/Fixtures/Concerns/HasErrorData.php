<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Concerns;

use Givebutter\Responses\Models\ErrorResponse;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type ErrorResponseSchema from ErrorResponse
 */
trait HasErrorData
{
    /**
     * @return ErrorResponseSchema
     */
    public static function errors(): array
    {
        /** @var ErrorResponseSchema $data */
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
