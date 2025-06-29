<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Tickets;

use Givebutter\Responses\Tickets\GetTicketResponse;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type GetTicketResponseSchema from GetTicketResponse
 */
final class GetTicketFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetTicketResponseSchema $data */
        $data = [
            'id' => fake()->text(),
            'id_suffix' => fake()->text(),
            'name' => fake()->text(),
            'first_name' => fake()->text(),
            'last_name' => fake()->text(),
            'email' => fake()->text(),
            'phone' => fake()->text(),
            'title' => fake()->text(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(50, 100),
            'pdf' => fake()->text(),
            'arrived_at' => fake()->iso8601(),
            'created_at' => fake()->iso8601(),
        ];

        return $data;
    }
}
