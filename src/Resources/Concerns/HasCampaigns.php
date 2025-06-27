<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Resources\CampaignsResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasCampaigns
{
    public function campaigns(): CampaignsResourceContract
    {
        return new CampaignsResource($this->connector);
    }
}
