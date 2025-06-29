<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Givebutter\Resources\ContactsResource;
use Givebutter\Responses\Contacts\GetContactsResponse;
use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Givebutter\Testing\Fixtures\Contacts\GetContactFixture;
use Givebutter\Testing\Fixtures\Contacts\GetContactsFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(ContactsResource::class);

describe(ContactsResource::class, function (): void {
    it('can retrieve a single contact', function (): void {
        // Arrange
        $client = ClientMock::get(
            'contacts/123',
            Response::from(GetContactFixture::data()),
        );

        // Act
        $result = $client->contacts()->get(123);

        // Assert
        expect($result)->toBeContact();
    });

    it('can retrieve all contacts', function (): void {
        // Arrange
        $client = ClientMock::get(
            'contacts',
            Response::from(GetContactsFixture::data()),
        );

        // Act
        $result = $client->contacts()->list();

        // Assert
        expect($result)->toBeInstanceOf(GetContactsResponse::class)
            ->data->each->toBeContact()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
    });

    it('can retrieve all contacts with a scope', function (): void {
        // Arrange
        $client = ClientMock::get(
            'contacts',
            Response::from(GetContactsFixture::data()),
            [
                'scope' => 'test',
            ]
        );

        // Act
        $result = $client->contacts()->list('test');

        // Assert
        expect($result)->toBeInstanceOf(GetContactsResponse::class)
            ->data->each->toBeContact()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
    });

    it('can create contacts', function (): void {
        // Arrange
        $payload = [
            'first_name' => 'Michael',
            'middle_name' => 'Gary',
            'last_name' => 'Scott',
            'email' => [
                [
                    'type' => 'work',
                    'value' => 'michael.scott@dundermifflin.com',
                ],
            ],
            'phones' => [
                [
                    'type' => 'work',
                    'value' => '(555) 867-5309',
                ],
            ],
            'addresses' => [
                [
                    'address_1' => '123 Paper St.',
                    'city' => 'Scranton',
                    'state' => 'PA',
                    'zipcode' => '18507',
                    'country' => 'US',
                ],
            ],
            'tags' => [
                'paper',
                'dunder mifflin',
            ],
            'dob' => CarbonImmutable::now()->addYears(-50)->toIsoString(),
            'company' => 'Dunder Mifflin',
            'title' => 'Regional Manager',
            'twitter_url' => 'https://twitter.com/dundermifflin',
            'linkedin_url' => 'https://linkedin.com/in/dundermifflin',
            'facebook_url' => 'https://facebook.com/dundermifflin',
        ];

        $client = ClientMock::post(
            'contacts',
            $payload,
            Response::from(GetContactFixture::data()),
            queryParams: [
                'force_create' => 'false',
            ],
        );

        // Act
        $result = $client->contacts()->create($payload);

        // Assert
        expect($result)->toBeContact();
    });

    it('can force create contacts', function (): void {
        // Arrange
        $payload = [
            'first_name' => 'Michael',
            'middle_name' => 'Gary',
            'last_name' => 'Scott',
            'email' => [
                [
                    'type' => 'work',
                    'value' => 'michael.scott@dundermifflin.com',
                ],
            ],
            'phones' => [
                [
                    'type' => 'work',
                    'value' => '(555) 867-5309',
                ],
            ],
            'addresses' => [
                [
                    'address_1' => '123 Paper St.',
                    'city' => 'Scranton',
                    'state' => 'PA',
                    'zipcode' => '18507',
                    'country' => 'US',
                ],
            ],
            'tags' => [
                'paper',
                'dunder mifflin',
            ],
            'dob' => CarbonImmutable::now()->addYears(-50)->toIso8601String(),
            'company' => 'Dunder Mifflin',
            'title' => 'Regional Manager',
            'twitter_url' => 'https://twitter.com/dundermifflin',
            'linkedin_url' => 'https://linkedin.com/in/dundermifflin',
            'facebook_url' => 'https://facebook.com/dundermifflin',
        ];

        $client = ClientMock::post(
            'contacts',
            $payload,
            Response::from(GetContactFixture::data()),
            [
                'force_create' => 'true',
            ],
        );

        // Act
        $result = $client->contacts()->create($payload, true);

        // Assert
        expect($result)->toBeContact();
    });
});
