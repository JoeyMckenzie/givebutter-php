<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Testing\Fixtures\Models\CoverFixture;
use Givebutter\Testing\Fixtures\Models\EventFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type CampaignSchema from GetCampaignResponse
 */
final class GetCampaignFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var CampaignSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'code' => fake()->text,
            'account_id' => fake()->text,
            'event_id' => fake()->numberBetween(1, 100),
            'type' => fake()->text,
            'title' => fake()->text,
            'subtitle' => fake()->text,
            'description' => fake()->text,
            'slug' => fake()->text,
            'url' => fake()->url,
            'goal' => fake()->numberBetween(1000, 1000),
            'raised' => fake()->numberBetween(1, 999),
            'donors' => fake()->numberBetween(1, 50),
            'currency' => fake()->text,
            'cover' => CoverFixture::data(),
            'status' => fake()->text,
            'timezone' => fake()->text,
            'end_at' => CarbonImmutable::now()->toIso8601String(),
            'created_at' => CarbonImmutable::now()->toIso8601String(),
            'updated_at' => CarbonImmutable::now()->toIso8601String(),
            'event' => EventFixture::data(),
        ];

        return $data;
    }
}
