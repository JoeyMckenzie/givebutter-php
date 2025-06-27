<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetCampaignTeamResponseSchema from GetCampaignTeamResponse
 */
final class GetCampaignTeamFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetCampaignTeamResponseSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'name' => fake()->name,
            'logo' => fake()->imageUrl,
            'slug' => fake()->text(),
            'url' => fake()->url,
            'raised' => fake()->numberBetween(100, 1000),
            'goal' => fake()->numberBetween(1000, 10000),
            'supporters' => fake()->numberBetween(1, 100),
            'members' => fake()->numberBetween(1, 10),
        ];

        return $data;
    }
}
