<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Models;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\EventResponse;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type EventResponseSchema from EventResponse
 */
final class EventFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var EventResponseSchema $data */
        $data = [
            'title' => fake()->text(),
            'type' => fake()->text(),
            'location_name' => fake()->text(),
            'address_formatted' => fake()->text(),
            'google_place_id' => fake()->text(),
            'start_at' => CarbonImmutable::now()->toIso8601String(),
            'end_at' => CarbonImmutable::now()->toIso8601String(),
            'timezone' => fake()->text(),
            'details' => fake()->text(),
            'private' => fake()->boolean(),
            'tickets_required' => fake()->boolean(),
            'livestream' => LivestreamFixture::data(),
            'livestream_start_at' => CarbonImmutable::now()->toIso8601String(),
            'livestream_end_at' => CarbonImmutable::now()->toIso8601String(),
        ];

        return $data;
    }
}
