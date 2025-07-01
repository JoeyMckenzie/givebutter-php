<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Concerns;

use Givebutter\Responses\Models\AddressResponse;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 */
trait HasAddressFixtureData
{
    /**
     * @return AddressResponseSchema
     */
    public static function address(): array
    {
        /** @var AddressResponseSchema $data */
        $data = [
            'address_1' => fake()->streetAddress(),
            'address_2' => fake()->boolean() ? fake()->streetAddress() : null,
            'city' => fake()->city,
            'state' => fake()->text(),
            'zipcode' => fake()->text(),
            'country' => fake()->country(),
            'type' => fake()->text(),
            'is_primary' => fake()->boolean(),
            'created_at' => fake()->iso8601(),
            'updated_at' => fake()->iso8601(),
        ];

        if (fake()->boolean()) {
            $data['id'] = fake()->numberBetween(1, 100);
        }

        if (fake()->boolean()) {
            $data['account_id'] = fake()->numberBetween(1, 100);
        }

        if (fake()->boolean()) {
            $data['name'] = fake()->text();
        }

        return $data;
    }
}
