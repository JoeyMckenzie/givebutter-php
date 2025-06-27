<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Responses\Campaigns\GetCampaignMembersResponse;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetCampaignMemberResponseSchema from GetCampaignMemberResponse
 * @phpstan-import-type GetCampaignMembersResponseSchema from GetCampaignMembersResponse
 */
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

    public function list(int $campaignId): GetCampaignMembersResponse
    {
        $request = ClientRequestBuilder::get("campaigns/$campaignId/members");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignMembersResponseSchema $data */
        $data = $response->data();

        return GetCampaignMembersResponse::from($data);
    }

    public function get(int $memberId, int $campaignId): GetCampaignMemberResponse
    {
        $request = ClientRequestBuilder::get("campaigns/$campaignId/members/$memberId");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignMemberResponseSchema $data */
        $data = $response->data();

        return GetCampaignMemberResponse::from($data);
    }

    public function delete(int $memberId, int $campaignId): ResponseInterface
    {
        $request = ClientRequestBuilder::delete("campaigns/$campaignId/members/$memberId");

        return $this->connector->sendStandardClientRequest($request);
    }
}
