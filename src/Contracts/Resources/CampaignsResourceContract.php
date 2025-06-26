<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Wrapkit\Contracts\ResourceContract;

interface CampaignsResourceContract extends ResourceContract
{
    public function members(): CampaignMembersResourceContract;

    public function teams(): CampaignTeamsResourceContract;

    public function get(int $id): GetCampaignResponse;

    public function list(?string $scope = null): GetCampaignsResponse;
}
