<?php

declare(strict_types=1);

use Givebutter\Resources\CampaignsResource;
use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignFixture;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignsFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(CampaignsResource::class);

describe('campaigns', function (): void {
    it('can retrieve a single campaign', function (): void {
        // Arrange
        $client = ClientMock::get(
            'campaigns/123',
            Response::from(GetCampaignFixture::data()),
        );

        // Act
        $result = $client->campaigns()->get(123);

        // Assert
        expect($result)->toBeCampaign();
    });

    it('can retrieve all campaigns', function (): void {
        // Arrange
        $client = ClientMock::get(
            'campaigns',
            Response::from(GetCampaignsFixture::data()),
        );

        // Act
        $result = $client->campaigns()->list();

        // Assert
        expect($result)->toBeInstanceOf(GetCampaignsResponse::class)
            ->data->each()->toBeCampaign()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
    });

    it('can retrieve all campaigns with a scope', function (): void {
        // Arrange
        $client = ClientMock::get(
            'campaigns',
            Response::from(GetCampaignsFixture::data()),
            [
                'scope' => 'test',
            ]
        );

        // Act
        $result = $client->campaigns()->list('test');

        // Assert
        expect($result)->toBeInstanceOf(GetCampaignsResponse::class)
            ->data->each()->toBeCampaign()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
    });
});
