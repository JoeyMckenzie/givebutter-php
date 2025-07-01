<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetCampaignMemberResponseSchema from GetCampaignMemberResponse
 */
final class GetCampaignMemberFixture extends AbstractDataFixture
{
    use HasErrorData;

    public static function data(): array
    {
        /** @var GetCampaignMemberResponseSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'display_name' => fake()->userName(),
            'picture' => fake()->imageUrl(),
            'raised' => fake()->numberBetween(100, 1000),
            'goal' => fake()->numberBetween(1000, 10000),
            'donors' => fake()->numberBetween(1, 100),
            'items' => fake()->numberBetween(1, 100),
            'url' => fake()->url(),
        ];

        return $data;
    }
}
