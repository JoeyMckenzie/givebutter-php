<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignMembersResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetCampaignMembersResponseSchema from GetCampaignMembersResponse
 */
final class GetCampaignMembersFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetCampaignMembersResponseSchema $data */
        $data = [
            'data' => array_map(static fn (): array => GetCampaignMemberFixture::data(), range(1, 3)),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
