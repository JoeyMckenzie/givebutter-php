<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\LinksResponse;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 */
final class LinksFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var LinksResponseSchema $data */
        $data = [
            'first' => 'https://api.example.com/resources?page=1',
            'last' => 'https://api.example.com/resources?page=5',
            'prev' => 'https://api.example.com/resources?page=4',
            'next' => 'https://api.example.com/resources?page=2',
        ];

        return $data;
    }
}
