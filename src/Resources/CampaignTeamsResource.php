<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Responses\Campaigns\GetCampaignTeamsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetCampaignTeamResponseSchema from GetCampaignTeamResponse
 * @phpstan-import-type GetCampaignTeamsResponseSchema from GetCampaignTeamsResponse
 */
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

    public function list(int $campaignId): GetCampaignTeamsResponse
    {
        $request = ClientRequestBuilder::get("campaigns/$campaignId/teams");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignTeamsResponseSchema $data */
        $data = $response->data();

        return GetCampaignTeamsResponse::from($data);
    }

    public function get(int $teamId, int $campaignId): GetCampaignTeamResponse
    {
        $request = ClientRequestBuilder::get("campaigns/$campaignId/teams/$teamId");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignTeamResponseSchema $data */
        $data = $response->data();

        return GetCampaignTeamResponse::from($data);
    }
}
