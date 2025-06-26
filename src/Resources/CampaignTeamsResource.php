<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class CampaignTeamsResource implements CampaignTeamsResourceContract
{
    public string $resource {
        get {
            return 'campaignTeams';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
