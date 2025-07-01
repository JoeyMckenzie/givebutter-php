<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Responses\Campaigns\GetCampaignTeamsResponse;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignTeamsFixture;

covers(GetCampaignTeamsResponse::class);

describe(GetCampaignTeamsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignTeamsFixture::data();
        $this->response = GetCampaignTeamsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetCampaignTeamsResponse::class)
            ->data->toBeArray()->each->toBeInstanceOf(GetCampaignTeamResponse::class)
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
        $fake = GetCampaignTeamsResponse::fake(GetCampaignTeamsFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetCampaignTeamsResponse::class)
            ->data->toBeArray()->each->toBeInstanceOf(GetCampaignTeamResponse::class)
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
