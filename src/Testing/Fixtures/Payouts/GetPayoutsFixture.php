<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Payouts;

use Givebutter\Responses\Payouts\GetPayoutsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetPayoutsResponseSchema from GetPayoutsResponse
 */
final class GetPayoutsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetPayoutsResponseSchema $data */
        $data = [
            'data' => array_map(static fn (): array => GetPayoutFixture::data(), range(1, 5)),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
