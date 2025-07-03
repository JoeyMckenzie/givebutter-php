<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Givebutter\Resources\CampaignsResource;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetCampaignResponseSchema from GetCampaignResponse
 * @phpstan-import-type GetCampaignsResponseSchema from GetCampaignsResponse
 *
 * @phpstan-type CampaignsResponseSchema GetCampaignResponseSchema|GetCampaignsResponseSchema
 */
final class CampaignsTestResource implements CampaignsResourceContract
{
    /**
     * @use Testable<CampaignsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return CampaignsResource::class;
        }
    }

    public function members(): CampaignMembersResourceContract
    {
        return new CampaignMembersTestResource($this->fake);
    }

    public function teams(): CampaignTeamsResourceContract
    {
        return new CampaignTeamsTestResource($this->fake);
    }

    public function get(int $id): GetCampaignResponse
    {
        /** @var GetCampaignResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(?string $scope = null): GetCampaignsResponse
    {
        /** @var GetCampaignsResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function create(array $params): GetCampaignResponse
    {
        /** @var GetCampaignResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function update(int $id, array $params): GetCampaignResponse
    {
        /** @var GetCampaignResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function delete(int $id): ResponseInterface
    {
        /** @var ResponseInterface $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
