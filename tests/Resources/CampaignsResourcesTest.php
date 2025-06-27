<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Givebutter\Resources\CampaignMembersResource;
use Givebutter\Resources\CampaignsResource;
use Givebutter\Resources\CampaignTeamsResource;
use Givebutter\Responses\Campaigns\GetCampaignMembersResponse;
use Givebutter\Responses\Campaigns\GetCampaignsResponse;
use Givebutter\Responses\Campaigns\GetCampaignTeamsResponse;
use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignFixture;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignMemberFixture;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignMembersFixture;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignsFixture;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignTeamFixture;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignTeamsFixture;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(CampaignsResource::class);
covers(CampaignMembersResource::class);
covers(CampaignTeamsResource::class);

describe(CampaignsResource::class, function (): void {
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

    it('can delete a campaign', function (): void {
        // Arrange
        $client = ClientMock::delete(
            'campaigns/123',
            new GuzzleResponse(200),
            methodName: 'sendStandardClientRequest'
        );

        // Act
        $result = $client->campaigns()->delete(123);

        // Assert
        expect($result)->toBeInstanceOf(ResponseInterface::class)
            ->and($result->getStatusCode())->toBe(200);
    });

    describe('members', function (): void {
        it('can retrieve a single campaign member', function (): void {
            // Arrange
            $client = ClientMock::get(
                'campaigns/123/members/321',
                Response::from(GetCampaignMemberFixture::data()),
            );

            // Act
            $result = $client
                ->campaigns()
                ->members()
                ->get(321, 123);

            // Assert
            expect($result)->toBeCampaignMember();
        });

        it('can retrieve all campaign members', function (): void {
            // Arrange
            $client = ClientMock::get(
                'campaigns/123/members',
                Response::from(GetCampaignMembersFixture::data()),
            );

            // Act
            $result = $client
                ->campaigns()
                ->members()
                ->list(123);

            // Assert
            expect($result)->toBeInstanceOf(GetCampaignMembersResponse::class)
                ->data->each()->toBeCampaignMember()
                ->meta->toBeInstanceOf(Meta::class)
                ->links->toBeInstanceOf(Links::class);
        });

        it('can delete a campaign member', function (): void {
            // Arrange
            $client = ClientMock::delete(
                'campaigns/123/members/321',
                new GuzzleResponse(200),
                methodName: 'sendStandardClientRequest'
            );

            // Act
            $result = $client
                ->campaigns()
                ->members()
                ->delete(321, 123);

            // Assert
            expect($result)->toBeInstanceOf(ResponseInterface::class)
                ->and($result->getStatusCode())->toBe(200);
        });
    });

    describe('teams', function (): void {
        it('can retrieve a single campaign team', function (): void {
            // Arrange
            $client = ClientMock::get(
                'campaigns/123/teams/321',
                Response::from(GetCampaignTeamFixture::data()),
            );

            // Act
            $result = $client
                ->campaigns()
                ->teams()
                ->get(321, 123);

            // Assert
            expect($result)->toBeCampaignTeam();
        });

        it('can retrieve all campaign teams', function (): void {
            // Arrange
            $client = ClientMock::get(
                'campaigns/123/teams',
                Response::from(GetCampaignTeamsFixture::data()),
            );

            // Act
            $result = $client
                ->campaigns()
                ->teams()
                ->list(123);

            // Assert
            expect($result)->toBeInstanceOf(GetCampaignTeamsResponse::class)
                ->data->each()->toBeCampaignTeam()
                ->meta->toBeInstanceOf(Meta::class)
                ->links->toBeInstanceOf(Links::class);
        });
    });
});
