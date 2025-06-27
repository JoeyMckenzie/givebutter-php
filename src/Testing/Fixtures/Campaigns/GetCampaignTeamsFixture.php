<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignTeamsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetCampaignTeamsResponseSchema from GetCampaignTeamsResponse
 */
final class GetCampaignTeamsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetCampaignTeamsResponseSchema $data */
        $data = [
            'data' => array_map(
                static fn (): array => GetCampaignTeamFixture::data(),
                range(1, fake()->numberBetween(1, 5)),
            ),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
