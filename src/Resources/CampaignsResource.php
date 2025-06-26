<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetCampaignSchema from GetCampaignResponse
 * @phpstan-import-type GetCampaignsSchema from GetCampaignsResponse
 */
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

    public function list(?string $scope = null): GetCampaignsResponse
    {
        $request = ClientRequestBuilder::get('campaigns')
            ->withQueryParam('scope', $scope);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignsSchema $data */
        $data = $response->data();

        return GetCampaignsResponse::from($data);
    }

    public function get(int $id): GetCampaignResponse
    {
        $request = ClientRequestBuilder::get("campaigns/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignSchema $data */
        $data = $response->data();

        return GetCampaignResponse::from($data);
    }
}
