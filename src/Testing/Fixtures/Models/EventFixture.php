<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\EventResponse;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type EventResponseSchema from EventResponse
 */
final class EventFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var EventResponseSchema $data */
        $data = [
            'title' => 'Annual Fundraiser Gala',
            'type' => 'in-person',
            'location_name' => 'Grand Ballroom',
            'address_formatted' => '123 Main St, New York, NY 10001',
            'google_place_id' => 'ChIJLU7jZClu5kcR4PcOOO6p3I0',
            'start_at' => CarbonImmutable::now()->toIso8601String(),
            'end_at' => CarbonImmutable::now()->toIso8601String(),
            'timezone' => 'America/New_York',
            'details' => 'Join us for our annual fundraiser gala with special guests and entertainment.',
            'private' => false,
            'tickets_required' => true,
            'livestream' => LivestreamFixture::data(),
            'livestream_start_at' => CarbonImmutable::now()->toIso8601String(),
            'livestream_end_at' => CarbonImmutable::now()->toIso8601String(),
        ];

        return $data;
    }
}
