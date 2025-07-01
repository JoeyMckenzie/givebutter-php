<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Responses\Campaigns\GetCampaignMembersResponse;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignMembersFixture;

covers(GetCampaignMembersResponse::class);

describe(GetCampaignMembersResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignMembersFixture::data();
        $this->response = GetCampaignMembersResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetCampaignMembersResponse::class)
            ->data->toBeArray()->each->toBeInstanceOf(GetCampaignMemberResponse::class)
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['data'])->toBeArray()
            ->and($data['meta'])->toBeArray()
            ->and($data['links'])->toBeArray();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetCampaignMembersResponse::fake(GetCampaignMembersFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetCampaignMembersResponse::class)
            ->data->toBeArray()->each->toBeInstanceOf(GetCampaignMemberResponse::class)
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
