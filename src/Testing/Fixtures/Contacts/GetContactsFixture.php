<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Contacts;

use Givebutter\Responses\Contacts\GetContactsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetContactsResponseSchema from GetContactsResponse
 */
final class GetContactsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetContactsResponseSchema $data */
        $data = [
            'data' => array_map(
                static fn (): array => GetContactFixture::data(),
                range(1, fake()->numberBetween(1, 5)),
            ),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
