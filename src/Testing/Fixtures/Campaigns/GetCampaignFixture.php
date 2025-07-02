<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Givebutter\Testing\Fixtures\Models\CoverFixture;
use Givebutter\Testing\Fixtures\Models\EventFixture;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetCampaignResponseSchema from GetCampaignResponse
 */
final class GetCampaignFixture extends AbstractDataFixture
{
    use HasErrorData;

    public static function data(): array
    {
        /** @var GetCampaignResponseSchema $data */
        $data = [
            'id' => 42,
            'code' => 'campaign-code-123',
            'account_id' => 'account-123',
            'event_id' => 55,
            'type' => 'fundraiser',
            'title' => 'Sample Campaign',
            'subtitle' => 'Supporting a great cause',
            'description' => 'This is a sample campaign description for testing purposes.',
            'slug' => 'sample-campaign',
            'url' => 'https://example.com/campaigns/sample-campaign',
            'goal' => 1000,
            'raised' => 750,
            'donors' => 25,
            'currency' => 'USD',
            'cover' => CoverFixture::data(),
            'status' => 'active',
            'timezone' => 'America/New_York',
            'end_at' => CarbonImmutable::now()->toIso8601String(),
            'created_at' => CarbonImmutable::now()->toIso8601String(),
            'updated_at' => CarbonImmutable::now()->toIso8601String(),
            'event' => EventFixture::data(),
        ];

        return $data;
    }
}
