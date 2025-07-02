<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 */
final class MetaFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var MetaResponseSchema $data */
        $data = [
            'current_page' => 1,
            'from' => 1,
            'last_page' => 5,
            'path' => 'https://api.example.com/resources',
            'per_page' => 20,
            'to' => 20,
            'total' => 95,
            'unfiltered_total' => 120,
            'links' => [
                [
                    'url' => 'https://api.example.com/resources?page=1',
                    'label' => '1',
                    'active' => true,
                ],
                [
                    'url' => 'https://api.example.com/resources?page=2',
                    'label' => '2',
                    'active' => false,
                ],
                [
                    'url' => 'https://api.example.com/resources?page=3',
                    'label' => '3',
                    'active' => false,
                ],
            ],
        ];

        return $data;
    }
}
