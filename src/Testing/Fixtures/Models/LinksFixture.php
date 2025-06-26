<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Givebutter\Responses\Models\Links;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type LinksSchema from Links
 */
final class LinksFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var LinksSchema $data */
        $data = [
            'first' => fake()->url,
            'last' => fake()->url,
            'prev' => fake()->url,
            'next' => fake()->url,
        ];

        return $data;
    }
}
