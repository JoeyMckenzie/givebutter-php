<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Wrapkit\Contracts\ResourceContract;

interface CampaignsResourceContract extends ResourceContract
{
    public function members(): CampaignMembersResourceContract;

    public function teams(): CampaignTeamsResourceContract;
}
