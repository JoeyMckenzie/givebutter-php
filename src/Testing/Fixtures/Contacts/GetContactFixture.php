<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Contacts;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Models\Address;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 */
final class GetContactFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetContactResponseSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'first_name' => fake()->firstName,
            'middle_name' => fake()->boolean ? fake()->name : null,
            'last_name' => fake()->lastName,
            'dob' => fake()->iso8601,
            'company' => fake()->company,
            'title' => fake()->title,
            'twitter_url' => fake()->boolean ? fake()->url : null,
            'linkedin_url' => fake()->boolean ? fake()->url : null,
            'facebook_url' => fake()->boolean ? fake()->url : null,
            'emails' => array_map(fn (): array => [
                'type' => fake()->text,
                'value' => fake()->email,
            ], range(1, fake()->numberBetween(1, 5))),
            'phones' => array_map(fn (): array => [
                'type' => fake()->text,
                'value' => fake()->phoneNumber,
            ], range(1, fake()->numberBetween(1, 5))),
            'primary_email' => fake()->email,
            'primary_phone' => fake()->phoneNumber,
            'note' => fake()->text,
            'addresses' => array_map(fn (): array => self::fakeAddress(), range(1, fake()->numberBetween(1, 5))),
            'primary_address' => self::fakeAddress(),
            'stats' => [
                'recurring_contributions' => fake()->numberBetween(100, 1000),
                'total_contributions' => fake()->numberBetween(100, 1000),
            ],
            'tags' => array_map(fn () => fake()->text, range(1, fake()->numberBetween(1, 5))),
            'archived_at' => fake()->iso8601,
            'created_at' => fake()->iso8601,
            'updated_at' => fake()->iso8601,
        ];

        return $data;
    }

    /**
     * @return AddressSchema
     */
    private static function fakeAddress(): array
    {
        return [
            'address_1' => fake()->streetAddress,
            'address_2' => fake()->streetAddress,
            'city' => fake()->city,
            'state' => fake()->text,
            'zipcode' => fake()->text,
            'country' => fake()->country,
            'type' => fake()->text,
            'is_primary' => fake()->boolean,
            'created_at' => fake()->iso8601,
            'updated_at' => fake()->iso8601,
        ];
    }
}
