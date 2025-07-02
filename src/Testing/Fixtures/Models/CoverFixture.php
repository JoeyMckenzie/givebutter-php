<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\CoverResponse;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type CoverResponseSchema from CoverResponse
 */
final class CoverFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var CoverResponseSchema $data */
        $data = [
            'type' => 'image',
            'url' => 'https://example.com/images/campaign-cover.jpg',
            'source' => 'upload',
        ];

        return $data;
    }
}
