<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\CustomFieldResponse;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type CustomFieldResponseSchema from CustomFieldResponse
 */
final class CustomFieldFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var CustomFieldResponseSchema $data */
        $data = [
            'id' => 42,
            'field_id' => 123,
            'type' => 'text',
            'value' => 'Sample custom field value',
            'title' => 'Custom Field',
            'description' => 'This is a sample custom field for testing',
        ];

        return $data;
    }
}
