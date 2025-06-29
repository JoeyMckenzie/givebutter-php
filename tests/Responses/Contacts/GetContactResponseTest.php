<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Testing\Fixtures\Contacts\GetContactFixture;

covers(GetContactResponse::class);

describe(GetContactResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetContactFixture::data();
        $this->response = GetContactResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeContact();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeInt()
            ->and($data['type'])->toBeString()
            ->and($data['prefix'])->toBeNullOrString()
            ->and($data['first_name'])->toBeString()
            ->and($data['middle_name'])->toBeNullOrString()
            ->and($data['last_name'])->toBeString()
            ->and($data['suffix'])->toBeNullOrString()
            ->and($data['gender'])->toBeNullOrString()
            ->and($data['dob'])->toBeNullOrString()
            ->and($data['company'])->toBeNullOrString()
            ->and($data['company_name'])->toBeNullOrString()
            ->and($data['employer'])->toBeNullOrString()
            ->and($data['point_of_contact'])->toBeNullOrString()
            ->and($data['associated_companies'])->toBeArray()
            ->and($data['title'])->toBeNullOrString()
            ->and($data['twitter_url'])->toBeNullOrString()
            ->and($data['linkedin_url'])->toBeNullOrString()
            ->and($data['facebook_url'])->toBeNullOrString()
            ->and($data['website_url'])->toBeNullOrString()
            ->and($data['emails'])->toBeArray()
            ->and($data['phones'])->toBeArray()
            ->and($data['primary_email'])->toBeString()
            ->and($data['primary_phone'])->toBeString()
            ->and($data['note'])->toBeNullOrString()
            ->and($data['addresses'])->toBeArray()
            ->and($data['primary_address'])->toBeArray()
            ->and($data['stats'])->toBeArray()
            ->and($data['tags'])->toBeArray()
            ->and($data['custom_fields'])->toBeArray()
            ->and($data['external_ids'])->toBeArray()
            ->and($data['is_email_subscribed'])->toBeBool()
            ->and($data['is_phone_subscribed'])->toBeBool()
            ->and($data['is_address_subscribed'])->toBeBool()
            ->and($data['address_unsubscribed_at'])->toBeNullOrString()
            ->and($data['archived_at'])->toBeNullOrString()
            ->and($data['created_at'])->toBeString()
            ->and($data['updated_at'])->toBeString()
            ->and($data['preferred_name'])->toBeNullOrString()
            ->and($data['salutation_name'])->toBeNullOrString();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetContactResponse::fake(GetContactFixture::class);

        // Assert

        expect($fake)->toBeContact();
    });

    it('can override nested properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetContactResponse::fake(GetContactFixture::class, [
            'primary_address' => [
                'city' => 'Scranton',
                'state' => 'PA',
            ],
        ]);

        // Assert
        expect($fake)->toBeContact()
            ->primaryAddress->city->toBe('Scranton')
            ->primaryAddress->state->toBe('PA');
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetContactResponse::fake(GetContactFixture::class, [
            'company' => 'Dunder Mifflin',
        ]);

        // Assert
        expect($fake)->toBeContact()
            ->company->toBe('Dunder Mifflin');
    });
});
