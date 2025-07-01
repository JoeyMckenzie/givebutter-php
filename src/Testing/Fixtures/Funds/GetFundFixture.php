<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Funds;

use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

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
            'id' => fake()->text(),
            'code' => fake()->text(),
            'name' => fake()->text(),
            'raised' => fake()->numberBetween(10, 100),
            'supporters' => fake()->numberBetween(10, 100),
            'created_at' => fake()->iso8601(),
            'updated_at' => fake()->iso8601(),
        ];

        return $data;
    }
}
