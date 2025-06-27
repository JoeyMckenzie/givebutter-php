<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignMemberFixture;

covers(GetCampaignMemberResponse::class);

describe(GetCampaignMemberResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignMemberFixture::data();
        $this->response = GetCampaignMemberResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeCampaignMember();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeInt()
            ->and($data['first_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['email'])->toBeString()
            ->and($data['phone'])->toBeString()
            ->and($data['display_name'])->toBeString()
            ->and($data['picture'])->toBeString()
            ->and($data['raised'])->toBeInt()
            ->and($data['goal'])->toBeInt()
            ->and($data['donors'])->toBeInt()
            ->and($data['items'])->toBeInt()
            ->and($data['url'])->toBeString();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetCampaignMemberResponse::fake(GetCampaignMemberFixture::class);

        // Assert

        expect($fake)->toBeCampaignMember();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignMemberResponse::fake(GetCampaignMemberFixture::class, [
            'raised' => 1234,
        ]);

        // Assert
        expect($fake)->toBeCampaignMember()
            ->raised->toBe(1234);
    });
});
