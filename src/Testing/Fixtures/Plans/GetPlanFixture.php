<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Plans;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Plans\GetPlanResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetPlanResponseSchema from GetPlanResponse
 */
final class GetPlanFixture extends AbstractDataFixture
{
    use HasErrorData;

    public static function data(): array
    {
        /** @var GetPlanResponseSchema $data */
        $data = [
            'id' => 'plan_12345',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '555-987-6543',
            'frequency' => 'monthly',
            'status' => 'active',
            'method' => 'credit_card',
            'amount' => 25,
            'fee_covered' => 2,
            'created_at' => CarbonImmutable::now()->toIso8601String(),
            'started_at' => CarbonImmutable::now()->toIso8601String(),
            'next_start_date' => CarbonImmutable::now()->toIso8601String(),
        ];

        return $data;
    }
}
