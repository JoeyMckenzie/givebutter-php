<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Plans;

use Givebutter\Responses\Plans\GetPlansResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetPlansResponseSchema from GetPlansResponse
 */
final class GetPlansFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetPlansResponseSchema $data */
        $data = [
            'data' => array_map(static fn (): array => GetPlanFixture::data(), range(1, 5)),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
