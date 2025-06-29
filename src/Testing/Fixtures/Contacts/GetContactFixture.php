<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Contacts;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Models\Company;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type CompanySchema from Company
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 */
final class GetContactFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetContactResponseSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'type' => fake()->text,
            'prefix' => fake()->text,
            'first_name' => fake()->firstName,
            'middle_name' => fake()->name,
            'last_name' => fake()->lastName,
            'suffix' => fake()->text,
            'gender' => fake()->text,
            'dob' => fake()->iso8601,
            'company' => fake()->company,
            'company_name' => fake()->company,
            'employer' => fake()->company,
            'point_of_contact' => fake()->name,
            'associated_companies' => array_map(static fn (): array => self::fakeCompany(), range(1, fake()->numberBetween(1, 5))),
            'title' => fake()->title,
            'twitter_url' => fake()->url,
            'linkedin_url' => fake()->url,
            'facebook_url' => fake()->url,
            'website_url' => fake()->url,
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
            'custom_fields' => array_map(fn (): array => [
                'id' => fake()->numberBetween(1, 100),
                'field_id' => fake()->numberBetween(1, 100),
                'type' => fake()->text,
                'value' => fake()->text,
                'title' => fake()->title,
                'description' => fake()->text,
            ], range(1, fake()->numberBetween(1, 5))),
            'external_ids' => range(1, fake()->numberBetween(1, 100)),
            'is_email_subscribed' => fake()->boolean,
            'is_phone_subscribed' => fake()->boolean,
            'is_address_subscribed' => fake()->boolean,
            'address_unsubscribed_at' => fake()->iso8601,
            'archived_at' => fake()->iso8601,
            'created_at' => fake()->iso8601,
            'updated_at' => fake()->iso8601,
            'preferred_name' => fake()->firstName,
            'salutation_name' => fake()->firstName,
        ];

        return $data;
    }

    /**
     * @return CompanySchema
     */
    private static function fakeCompany(): array
    {
        return [
            'id' => fake()->numberBetween(1, 100),
            'type' => fake()->text,
            'company_name' => fake()->company,
            'title' => fake()->title,
            'twitter_url' => fake()->url,
            'linkedin_url' => fake()->url,
            'facebook_url' => fake()->url,
            'website_url' => fake()->url,
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
            'is_email_subscribed' => fake()->boolean,
            'is_phone_subscribed' => fake()->boolean,
            'is_address_subscribed' => fake()->boolean,
            'address_unsubscribed_at' => fake()->iso8601,
            'archived_at' => fake()->iso8601,
            'created_at' => fake()->iso8601,
            'updated_at' => fake()->iso8601,
            'first_time_supporter_at' => fake()->iso8601,
        ];
    }

    /**
     * @return AddressSchema
     */
    private static function fakeAddress(): array
    {
        return [
            'id' => fake()->numberBetween(1, 100),
            'account_id' => fake()->numberBetween(1, 100),
            'name' => fake()->text,
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
