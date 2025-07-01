<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignFixture;

covers(GetCampaignResponse::class);

describe(GetCampaignResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignFixture::data();
        $this->response = GetCampaignResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeCampaign()
            ->and($this->response->hasErrorMessage())->toBeFalse();
    });

    it('can contain errors', function (): void {
        // Arrange
        $errors = GetCampaignFixture::errors();

        // Act
        $response = GetCampaignResponse::from($errors);

        // Assert
        expect($response)->toBeCampaignWithErrors()
            ->and($response->hasErrorMessage())->toBeTrue();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeInt()
            ->and($data['code'])->toBeString()
            ->and($data['account_id'])->toBeString()
            ->and($data['event_id'])->toBeInt()
            ->and($data['type'])->toBeString()
            ->and($data['title'])->toBeString()
            ->and($data['subtitle'])->toBeString()
            ->and($data['description'])->toBeString()
            ->and($data['slug'])->toBeString()
            ->and($data['url'])->toBeString()
            ->and($data['goal'])->toBeInt()
            ->and($data['raised'])->toBeInt()
            ->and($data['donors'])->toBeInt()
            ->and($data['currency'])->toBeString()
            ->and($data['cover'])->toBeArray()
            ->and($data['status'])->toBeString()
            ->and($data['timezone'])->toBeString()
            ->and($data['end_at'])->toBeString()
            ->and($data['created_at'])->toBeString()
            ->and($data['updated_at'])->toBeString()
            ->and($data['event'])->toBeArray()
            ->and($data['message'])->toBeNull();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class);

        // Assert
        expect($fake)->toBeCampaign();
    });

    it('can override nested properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class, [
            'cover' => [
                'url' => 'https://php.net/',
            ],
        ]);

        // Assert
        expect($fake)->toBeCampaign()
            ->cover->url->toBe('https://php.net/');
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class, [
            'description' => 'campaign description',
        ]);

        // Assert
        expect($fake)->toBeCampaign()
            ->description->toBe('campaign description');
    });

    it('handles nullable objects on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class, [
            'event' => null,
            'cover' => null,
            'end_at' => null,
        ]);
        $data = $fake->toArray();

        // Assert
        expect($fake)->toBeInstanceOf(GetCampaignResponse::class)
            ->event->toBeNull()
            ->cover->toBeNull()
            ->endAt->toBeNull();

        expect($data['event'])->toBeNull()
            ->and($data['cover'])->toBeNull()
            ->and($data['end_at'])->toBeNull();
    });

    it('handles null dates', function (): void {
        // Arrange
        $data = GetCampaignFixture::data();
        $data['created_at'] = null;
        $data['updated_at'] = null;

        // Act
        $response = GetCampaignResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response)->toBeInstanceOf(GetCampaignResponse::class)
            ->createdAt->toBeNull()
            ->and($arrayData['created_at'])->toBeNull()
            ->updatedAt->toBeNull()
            ->and($arrayData['updated_at'])->toBeNull();
    });
});
