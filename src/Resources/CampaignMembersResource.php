<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class CampaignMembersResource implements CampaignMembersResourceContract
{
    public string $resource {
        get {
            return 'campaignMembers';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
