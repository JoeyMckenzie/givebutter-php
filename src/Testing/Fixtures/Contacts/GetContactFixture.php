<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Contacts;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Models\CompanyResponse;
use Givebutter\Testing\Fixtures\Concerns\HasAddressFixtureData;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Givebutter\Testing\Fixtures\Models\CustomFieldFixture;
use Wrapkit\Testing\AbstractDataFixture;

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
            'id' => 42,
            'type' => 'individual',
            'prefix' => 'Mr.',
            'first_name' => 'Robert',
            'middle_name' => 'James',
            'last_name' => 'Williams',
            'suffix' => 'Jr.',
            'gender' => 'male',
            'dob' => CarbonImmutable::now()->toIso8601String(),
            'company' => 'Acme Corporation',
            'company_name' => 'Acme Corporation',
            'employer' => 'Acme Corporation',
            'point_of_contact' => 'Sarah Johnson',
            'associated_companies' => [self::fakeCompany(), self::fakeCompany()],
            'title' => 'Director',
            'twitter_url' => 'https://twitter.com/robertwilliams',
            'linkedin_url' => 'https://linkedin.com/in/robertwilliams',
            'facebook_url' => 'https://facebook.com/robertwilliams',
            'website_url' => 'https://robertwilliams.example.com',
            'emails' => [
                [
                    'type' => 'work',
                    'value' => 'robert.williams@example.com',
                ],
                [
                    'type' => 'personal',
                    'value' => 'rwilliams@gmail.example.com',
                ],
            ],
            'phones' => [
                [
                    'type' => 'mobile',
                    'value' => '555-123-4567',
                ],
                [
                    'type' => 'work',
                    'value' => '555-987-6543',
                ],
            ],
            'primary_email' => 'robert.williams@example.com',
            'primary_phone' => '555-123-4567',
            'note' => 'Regular donor since 2020',
            'addresses' => [self::address(), self::address()],
            'primary_address' => self::address(),
            'stats' => [
                'recurring_contributions' => 250,
                'total_contributions' => 750,
            ],
            'tags' => ['donor', 'volunteer', 'vip'],
            'custom_fields' => [CustomFieldFixture::data(), CustomFieldFixture::data()],
            'external_ids' => [1, 2, 3],
            'is_email_subscribed' => true,
            'is_phone_subscribed' => true,
            'is_address_subscribed' => true,
            'address_unsubscribed_at' => CarbonImmutable::now()->toIso8601String(),
            'archived_at' => CarbonImmutable::now()->toIso8601String(),
            'created_at' => CarbonImmutable::now()->toIso8601String(),
            'updated_at' => CarbonImmutable::now()->toIso8601String(),
            'preferred_name' => 'Rob',
            'salutation_name' => 'Robert',
        ];

        return $data;
    }

    /**
     * @return CompanyResponseSchema
     */
    private static function fakeCompany(): array
    {
        return [
            'id' => 123,
            'type' => 'corporation',
            'company_name' => 'Acme Corporation',
            'title' => 'CEO',
            'twitter_url' => 'https://twitter.com/acmecorp',
            'linkedin_url' => 'https://linkedin.com/company/acmecorp',
            'facebook_url' => 'https://facebook.com/acmecorp',
            'website_url' => 'https://acmecorp.example.com',
            'emails' => [
                [
                    'type' => 'info',
                    'value' => 'info@acmecorp.example.com',
                ],
                [
                    'type' => 'support',
                    'value' => 'support@acmecorp.example.com',
                ],
            ],
            'phones' => [
                [
                    'type' => 'main',
                    'value' => '555-123-4567',
                ],
                [
                    'type' => 'fax',
                    'value' => '555-987-6543',
                ],
            ],
            'primary_email' => 'info@acmecorp.example.com',
            'primary_phone' => '555-123-4567',
            'note' => 'Corporate sponsor since 2018',
            'addresses' => [self::address()],
            'primary_address' => self::address(),
            'is_email_subscribed' => true,
            'is_phone_subscribed' => true,
            'is_address_subscribed' => true,
            'address_unsubscribed_at' => CarbonImmutable::now()->toIso8601String(),
            'archived_at' => CarbonImmutable::now()->toIso8601String(),
            'created_at' => CarbonImmutable::now()->toIso8601String(),
            'updated_at' => CarbonImmutable::now()->toIso8601String(),
            'first_time_supporter_at' => CarbonImmutable::now()->toIso8601String(),
        ];
    }
}
