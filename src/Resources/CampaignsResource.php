<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class CampaignsResource implements CampaignsResourceContract
{
    public string $resource {
        get {
            return 'campaigns';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function members(): CampaignMembersResourceContract
    {
        return new CampaignMembersResource($this->connector);
    }

    public function teams(): CampaignTeamsResourceContract
    {
        return new CampaignTeamsResource($this->connector);
    }
}
