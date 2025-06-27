<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignTeamFixture;

covers(GetCampaignTeamResponse::class);

describe(GetCampaignTeamResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignTeamFixture::data();
        $this->response = GetCampaignTeamResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeCampaignTeam();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeInt()
            ->and($data['name'])->toBeString()
            ->and($data['logo'])->toBeString()
            ->and($data['slug'])->toBeString()
            ->and($data['url'])->toBeString()
            ->and($data['raised'])->toBeInt()
            ->and($data['goal'])->toBeInt()
            ->and($data['supporters'])->toBeInt()
            ->and($data['members'])->toBeInt();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetCampaignTeamResponse::fake(GetCampaignTeamFixture::class);

        // Assert

        expect($fake)->toBeCampaignTeam();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignTeamResponse::fake(GetCampaignTeamFixture::class, [
            'raised' => 1234,
        ]);

        // Assert
        expect($fake)->toBeCampaignTeam()
            ->raised->toBe(1234);
    });
});
