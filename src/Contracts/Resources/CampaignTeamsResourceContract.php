<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Responses\Campaigns\GetCampaignTeamsResponse;
use Wrapkit\Contracts\ResourceContract;

interface CampaignTeamsResourceContract extends ResourceContract
{
    public function list(int $campaignId): GetCampaignTeamsResponse;

    public function get(int $teamId, int $campaignId): GetCampaignTeamResponse;
}
