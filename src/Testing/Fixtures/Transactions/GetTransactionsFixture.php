<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Transactions;

use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetTransactionsResponseSchema from GetTransactionsResponse
 */
final class GetTransactionsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetTransactionsResponseSchema $data */
        $data = [
            'data' => array_map(
                static fn (): array => GetTransactionFixture::data(),
                range(1, fake()->numberBetween(1, 5)),
            ),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
