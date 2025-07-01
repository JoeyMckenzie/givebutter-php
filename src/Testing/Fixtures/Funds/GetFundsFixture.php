<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Funds;

use Givebutter\Responses\Funds\GetFundsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetFundsResponseSchema from GetFundsResponse
 */
final class GetFundsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetFundsResponseSchema $data */
        $data = [
            'data' => array_map(
                static fn (): array => GetFundFixture::data(),
                range(1, fake()->numberBetween(1, 5)),
            ),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
