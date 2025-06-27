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
 * @phpstan-import-type GetCampaignResponseSchema from GetCampaignResponse
 * @phpstan-import-type GetCampaignsResponseSchema from GetCampaignsResponse
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
        $request = ClientRequestBuilder::get($this->resource)
            ->withQueryParam('scope', $scope);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignsResponseSchema $data */
        $data = $response->data();

        return GetCampaignsResponse::from($data);
    }

    public function get(int $id): GetCampaignResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignResponseSchema $data */
        $data = $response->data();

        return GetCampaignResponse::from($data);
    }

    /**
     * @param array{
     *     description: string,
     *     end_at: string,
     *     goal: int,
     *     subtitle: string,
     *     slug: string,
     *     title: string,
     *     type: string,
     * } $params
     */
    public function create(array $params): GetCampaignResponse
    {
        $request = ClientRequestBuilder::post($this->resource)
            ->withRequestContent($params);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetCampaignResponseSchema $data */
        $data = $response->data();

        return GetCampaignResponse::from($data);
    }
}
