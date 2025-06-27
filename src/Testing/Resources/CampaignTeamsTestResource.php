<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Responses\Campaigns\GetCampaignTeamsResponse;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetCampaignTeamResponseSchema from GetCampaignTeamResponse
 * @phpstan-import-type GetCampaignTeamsResponseSchema from GetCampaignTeamsResponse
 *
 * @phpstan-type CampaignTeamsResponseSchema GetCampaignTeamResponseSchema|GetCampaignTeamsResponseSchema
 */
final class CampaignTeamsTestResource implements CampaignTeamsResourceContract
{
    /**
     * @use Testable<CampaignTeamsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return 'campaignMembers';
        }
    }

    public function get(int $teamId, int $campaignId): GetCampaignTeamResponse
    {
        /** @var GetCampaignTeamResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(int $campaignId): GetCampaignTeamsResponse
    {
        /** @var GetCampaignTeamsResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
