<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Responses\Campaigns\GetCampaignMembersResponse;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Contracts\ResourceContract;

interface CampaignMembersResourceContract extends ResourceContract
{
    public function get(int $memberId, int $campaignId): GetCampaignMemberResponse;

    public function list(int $campaignId): GetCampaignMembersResponse;

    public function delete(int $memberId, int $campaignId): ResponseInterface;
}
