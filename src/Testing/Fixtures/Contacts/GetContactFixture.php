<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Contacts;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Models\CompanyResponse;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Givebutter\Testing\Fixtures\Models\CustomFieldFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 * @phpstan-import-type CompanyResponseSchema from CompanyResponse
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 */
final class GetContactFixture extends AbstractDataFixture
{
    use HasAddressFixtureData, HasErrorData;

    public static function data(): array
    {
        /** @var GetContactResponseSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'type' => fake()->text(),
            'prefix' => fake()->text,
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->name,
            'last_name' => fake()->lastName(),
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
                'type' => fake()->text(),
                'value' => fake()->email(),
            ], range(1, fake()->numberBetween(1, 5))),
            'phones' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->phoneNumber(),
            ], range(1, fake()->numberBetween(1, 5))),
            'primary_email' => fake()->email,
            'primary_phone' => fake()->phoneNumber,
            'note' => fake()->text,
            'addresses' => array_map(fn (): array => self::address(), range(1, fake()->numberBetween(1, 5))),
            'primary_address' => self::address(),
            'stats' => [
                'recurring_contributions' => fake()->numberBetween(100, 1000),
                'total_contributions' => fake()->numberBetween(100, 1000),
            ],
            'tags' => array_map(fn () => fake()->text(), range(1, fake()->numberBetween(1, 5))),
            'custom_fields' => array_map(fn (): array => CustomFieldFixture::data(), range(1, fake()->numberBetween(1, 5))),
            'external_ids' => range(1, fake()->numberBetween(1, 100)),
            'is_email_subscribed' => fake()->boolean(),
            'is_phone_subscribed' => fake()->boolean(),
            'is_address_subscribed' => fake()->boolean(),
            'address_unsubscribed_at' => fake()->iso8601,
            'archived_at' => fake()->iso8601,
            'created_at' => fake()->iso8601(),
            'updated_at' => fake()->iso8601(),
            'preferred_name' => fake()->firstName,
            'salutation_name' => fake()->firstName(),
        ];

        return $data;
    }

    /**
     * @return CompanyResponseSchema
     */
    private static function fakeCompany(): array
    {
        return [
            'id' => fake()->numberBetween(1, 100),
            'type' => fake()->text(),
            'company_name' => fake()->company(),
            'title' => fake()->title,
            'twitter_url' => fake()->url,
            'linkedin_url' => fake()->url,
            'facebook_url' => fake()->url,
            'website_url' => fake()->url,
            'emails' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->email(),
            ], range(1, fake()->numberBetween(1, 5))),
            'phones' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->phoneNumber(),
            ], range(1, fake()->numberBetween(1, 5))),
            'primary_email' => fake()->email,
            'primary_phone' => fake()->phoneNumber,
            'note' => fake()->text,
            'addresses' => array_map(fn (): array => self::address(), range(1, fake()->numberBetween(1, 5))),
            'primary_address' => self::address(),
            'is_email_subscribed' => fake()->boolean(),
            'is_phone_subscribed' => fake()->boolean(),
            'is_address_subscribed' => fake()->boolean(),
            'address_unsubscribed_at' => fake()->iso8601(),
            'archived_at' => fake()->iso8601,
            'created_at' => fake()->iso8601(),
            'updated_at' => fake()->iso8601(),
            'first_time_supporter_at' => fake()->iso8601,
        ];
    }
}
