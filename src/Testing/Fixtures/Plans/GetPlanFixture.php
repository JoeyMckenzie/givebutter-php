<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Plans;

use Givebutter\Responses\Plans\GetPlanResponse;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetPlanResponseSchema from GetPlanResponse
 */
final class GetPlanFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetPlanResponseSchema $data */
        $data = [
            'id' => fake()->text(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'frequency' => fake()->text(),
            'status' => fake()->text(),
            'method' => fake()->text(),
            'amount' => fake()->numberBetween(10, 100),
            'fee_covered' => fake()->numberBetween(10, 100),
            'created_at' => fake()->iso8601(),
            'started_at' => fake()->iso8601(),
            'next_start_date' => fake()->iso8601(),
        ];

        return $data;
    }
}
