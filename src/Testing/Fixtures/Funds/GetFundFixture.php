<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Funds;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetFundResponseSchema from GetFundResponse
 */
final class GetFundFixture extends AbstractDataFixture
{
    use HasErrorData;

    public static function data(): array
    {
        /** @var GetFundResponseSchema $data */
        $data = [
            'id' => 'fund_12345',
            'code' => 'FUND-12345',
            'name' => 'Education Fund',
            'raised' => 75000,
            'supporters' => 250,
            'created_at' => CarbonImmutable::now()->toIso8601String(),
            'updated_at' => CarbonImmutable::now()->toIso8601String(),
        ];

        return $data;
    }
}
