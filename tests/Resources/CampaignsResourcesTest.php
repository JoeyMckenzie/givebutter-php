<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
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

    it('can create campaigns', function (): void {
        // Arrange
        $payload = [
            'description' => 'This is a test campaign.',
            'end_at' => CarbonImmutable::now()->toIso8601String(),
            'goal' => 1000,
            'subtitle' => 'subtitle',
            'slug' => 'slug123',
            'title' => 'title',
            'type' => 'collect',
        ];

        $client = ClientMock::post(
            'campaigns',
            $payload,
            Response::from(GetCampaignFixture::data()),
        );

        // Act
        $result = $client->campaigns()->create($payload);

        // Assert
        expect($result)->toBeCampaign();
    });

    it('can update campaigns', function (): void {
        // Arrange
        $payload = [
            'description' => 'This is an updated test campaign.',
            'end_at' => CarbonImmutable::now()->toIso8601String(),
            'goal' => 10000,
            'subtitle' => 'updated subtitle',
            'slug' => 'updatedSlug123',
            'title' => 'updated title',
            'type' => 'updated collect',
        ];

        $client = ClientMock::patch(
            'campaigns/123',
            $payload,
            Response::from(GetCampaignFixture::data()),
        );

        // Act
        $result = $client->campaigns()->update(123, $payload);

        // Assert
        expect($result)->toBeCampaign();
    });
});
