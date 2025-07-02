<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetCampaignTeamResponseSchema from GetCampaignTeamResponse
 */
final class GetCampaignTeamFixture extends AbstractDataFixture
{
    use HasErrorData;

    public static function data(): array
    {
        /** @var GetCampaignTeamResponseSchema $data */
        $data = [
            'id' => 33,
            'name' => 'Team Awesome',
            'logo' => 'https://example.com/logos/team-awesome.png',
            'slug' => 'team-awesome',
            'url' => 'https://example.com/teams/team-awesome',
            'raised' => 750,
            'goal' => 5000,
            'supporters' => 45,
            'members' => 8,
        ];

        return $data;
    }
}
