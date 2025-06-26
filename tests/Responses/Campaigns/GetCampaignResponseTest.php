<?php

declare(strict_types=1);

namespace Tests\Responses;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Responses\Models\Cover;
use Givebutter\Responses\Models\Event;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignFixture;

covers(GetCampaignResponse::class);

describe(GetCampaignResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetCampaignFixture::data();
        $this->response = GetCampaignResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetCampaignResponse::class)
            ->id->toBeInt()
            ->code->toBeString()
            ->accountId->toBeString()
            ->eventId->toBeInt()
            ->type->toBeString()
            ->title->toBeString()
            ->subtitle->toBeString()
            ->description->toBeString()
            ->slug->toBeString()
            ->url->toBeString()
            ->goal->toBeInt()
            ->raised->toBeInt()
            ->donors->toBeInt()
            ->currency->toBeString()
            ->status->toBeString()
            ->timezone->toBeString()
            ->endAt->toBeInstanceOf(CarbonImmutable::class)
            ->createdAt->toBeInstanceOf(CarbonImmutable::class)
            ->updatedAt->toBeInstanceOf(CarbonImmutable::class)
            ->cover->toBeInstanceOf(Cover::class)
            ->event->toBeInstanceOf(Event::class);
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
            ->and($data['event'])->toBeArray();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetCampaignResponse::class)
            ->id->toBeInt()
            ->code->toBeString()
            ->accountId->toBeString()
            ->eventId->toBeInt()
            ->type->toBeString()
            ->title->toBeString()
            ->subtitle->toBeString()
            ->description->toBeString()
            ->slug->toBeString()
            ->url->toBeString()
            ->goal->toBeInt()
            ->raised->toBeInt()
            ->donors->toBeInt()
            ->currency->toBeString()
            ->status->toBeString()
            ->timezone->toBeString()
            ->endAt->toBeInstanceOf(CarbonImmutable::class)
            ->createdAt->toBeInstanceOf(CarbonImmutable::class)
            ->updatedAt->toBeInstanceOf(CarbonImmutable::class)
            ->cover->toBeInstanceOf(Cover::class)
            ->event->toBeInstanceOf(Event::class);
    });

    it('can override nested properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class, [
            'cover' => [
                'url' => 'https://php.net/',
            ],
        ]);

        // Assert
        expect($fake)->toBeInstanceOf(GetCampaignResponse::class)
            ->cover->url->toBeString('https://php.net/');
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetCampaignResponse::fake(GetCampaignFixture::class, [
            'description' => 'campaign description',
        ]);

        // Assert
        expect($fake)->toBeInstanceOf(GetCampaignResponse::class)
            ->description->toBeString('campaign description');
    });

    it('handles nullable nested objects', function (): void {
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
});
