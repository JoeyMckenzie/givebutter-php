<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Contacts;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Models\Company;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Givebutter\Testing\Fixtures\Models\CustomFieldFixture;
use Wrapkit\Testing\AbstractDataFixture;

use function Pest\Faker\fake;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type CompanySchema from Company
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 */
final class GetContactFixture extends AbstractDataFixture
{
    use HasAddressFixtureData;

    public static function data(): array
    {
        /** @var GetContactResponseSchema $data */
        $data = [
            'id' => fake()->numberBetween(1, 100),
            'type' => fake()->text(),
            'prefix' => fake()->boolean() ? fake()->text() : null,
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->boolean() ? fake()->name() : null,
            'last_name' => fake()->lastName(),
            'suffix' => fake()->boolean() ? fake()->text() : null,
            'gender' => fake()->boolean() ? fake()->text() : null,
            'dob' => fake()->boolean() ? fake()->iso8601() : null,
            'company' => fake()->boolean() ? fake()->company() : null,
            'company_name' => fake()->boolean() ? fake()->company() : null,
            'employer' => fake()->boolean() ? fake()->company() : null,
            'point_of_contact' => fake()->boolean() ? fake()->name() : null,
            'associated_companies' => array_map(static fn (): array => self::fakeCompany(), range(1, fake()->numberBetween(1, 5))),
            'title' => fake()->boolean() ? fake()->title() : null,
            'twitter_url' => fake()->boolean() ? fake()->url() : null,
            'linkedin_url' => fake()->boolean() ? fake()->url() : null,
            'facebook_url' => fake()->boolean() ? fake()->url() : null,
            'website_url' => fake()->boolean() ? fake()->url() : null,
            'emails' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->email(),
            ], range(1, fake()->numberBetween(1, 5))),
            'phones' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->phoneNumber(),
            ], range(1, fake()->numberBetween(1, 5))),
            'primary_email' => fake()->boolean() ? fake()->email() : null,
            'primary_phone' => fake()->boolean() ? fake()->phoneNumber() : null,
            'note' => fake()->boolean() ? fake()->text() : null,
            'addresses' => array_map(fn (): array => self::address(), range(1, fake()->numberBetween(1, 5))),
            'primary_address' => fake()->boolean() ? self::address() : null,
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
            'address_unsubscribed_at' => fake()->boolean() ? fake()->iso8601() : null,
            'archived_at' => fake()->boolean() ? fake()->iso8601() : null,
            'created_at' => fake()->iso8601(),
            'updated_at' => fake()->iso8601(),
            'preferred_name' => fake()->boolean() ? fake()->firstName() : null,
            'salutation_name' => fake()->firstName(),
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
            'type' => fake()->text(),
            'company_name' => fake()->company(),
            'title' => fake()->boolean() ? fake()->title() : null,
            'twitter_url' => fake()->boolean() ? fake()->url() : null,
            'linkedin_url' => fake()->boolean() ? fake()->url() : null,
            'facebook_url' => fake()->boolean() ? fake()->url() : null,
            'website_url' => fake()->boolean() ? fake()->url() : null,
            'emails' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->email(),
            ], range(1, fake()->numberBetween(1, 5))),
            'phones' => array_map(fn (): array => [
                'type' => fake()->text(),
                'value' => fake()->phoneNumber(),
            ], range(1, fake()->numberBetween(1, 5))),
            'primary_email' => fake()->boolean() ? fake()->email() : null,
            'primary_phone' => fake()->boolean() ? fake()->phoneNumber() : null,
            'note' => fake()->boolean() ? fake()->text() : null,
            'addresses' => array_map(fn (): array => self::address(), range(1, fake()->numberBetween(1, 5))),
            'primary_address' => fake()->boolean() ? self::address() : null,
            'is_email_subscribed' => fake()->boolean(),
            'is_phone_subscribed' => fake()->boolean(),
            'is_address_subscribed' => fake()->boolean(),
            'address_unsubscribed_at' => fake()->iso8601(),
            'archived_at' => fake()->boolean() ? fake()->iso8601() : null,
            'created_at' => fake()->iso8601(),
            'updated_at' => fake()->iso8601(),
            'first_time_supporter_at' => fake()->boolean() ? fake()->iso8601() : null,
        ];
    }
}
