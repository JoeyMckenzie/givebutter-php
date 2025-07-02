<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetCampaignsResponseSchema from GetCampaignsResponse
 */
final class GetCampaignsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetCampaignsResponseSchema $data */
        $data = [
            'data' => array_map(static fn (): array => GetCampaignFixture::data(), range(1, 3)),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
