<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Concerns;

use Givebutter\Responses\Models\ErrorResponse;

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
            'message' => 'Validation failed',
            'errors' => [
                'field.0.value' => [
                    'The field value is invalid',
                ],
                'field.1.value' => [
                    'The field value is required',
                ],
            ],
        ];

        return $data;
    }
}
