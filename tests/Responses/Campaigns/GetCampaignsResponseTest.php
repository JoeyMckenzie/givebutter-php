<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignsFixture;

covers(GetCampaignsResponse::class);

describe(GetCampaignsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignsFixture::data();
        $this->response = GetCampaignsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetCampaignsResponse::class)
            ->data->toBeArray()->each->toBeCampaign()
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
        $fake = GetCampaignsResponse::fake(GetCampaignsFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetCampaignsResponse::class)
            ->data->toBeArray()->each->toBeCampaign()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
