<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Responses\Campaigns\GetCampaignMembersResponse;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetCampaignMemberResponseSchema from GetCampaignMemberResponse
 * @phpstan-import-type GetCampaignMembersResponseSchema from GetCampaignMembersResponse
 *
 * @phpstan-type CampaignMembersResponseSchema GetCampaignMemberResponseSchema|GetCampaignMembersResponseSchema
 */
final class CampaignMembersTestResource implements CampaignMembersResourceContract
{
    /**
     * @use Testable<CampaignMembersResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return 'campaignMembers';
        }
    }

    public function get(int $memberId, int $campaignId): GetCampaignMemberResponse
    {
        /** @var GetCampaignMemberResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(int $campaignId): GetCampaignMembersResponse
    {
        /** @var GetCampaignMembersResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function delete(int $memberId, int $campaignId): ResponseInterface
    {
        /** @var ResponseInterface $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
