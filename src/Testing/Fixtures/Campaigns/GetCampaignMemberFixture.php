<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Campaigns;

use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

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
            'id' => 75,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '555-123-4567',
            'display_name' => 'JohnD',
            'picture' => 'https://example.com/profile/johndoe.jpg',
            'raised' => 850,
            'goal' => 5000,
            'donors' => 42,
            'items' => 15,
            'url' => 'https://example.com/members/johndoe',
        ];

        return $data;
    }
}
