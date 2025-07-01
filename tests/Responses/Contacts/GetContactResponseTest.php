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
        expect($this->response)->toBeContact()
            ->and($this->response->hasErrorMessage())->toBeFalse()
            ->and($this->response->hasErrors())->toBeFalse();
    });

    it('can contain errors', function (): void {
        // Arrange
        $errors = GetContactFixture::errors();

        // Act
        $response = GetContactResponse::from($errors);

        // Assert
        expect($response)->toBeContactWithErrors()
            ->and($response->hasErrorMessage())->toBeTrue()
            ->and($response->hasErrors())->toBeTrue();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeInt()
            ->and($data['type'])->toBeString()
            ->and($data['prefix'])->toBeString()
            ->and($data['first_name'])->toBeString()
            ->and($data['middle_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['suffix'])->toBeString()
            ->and($data['gender'])->toBeString()
            ->and($data['dob'])->toBeString()
            ->and($data['company'])->toBeString()
            ->and($data['company_name'])->toBeString()
            ->and($data['employer'])->toBeString()
            ->and($data['point_of_contact'])->toBeString()
            ->and($data['associated_companies'])->toBeArray()
            ->and($data['title'])->toBeString()
            ->and($data['twitter_url'])->toBeString()
            ->and($data['linkedin_url'])->toBeString()
            ->and($data['facebook_url'])->toBeString()
            ->and($data['website_url'])->toBeString()
            ->and($data['emails'])->toBeArray()
            ->and($data['phones'])->toBeArray()
            ->and($data['primary_email'])->toBeString()
            ->and($data['primary_phone'])->toBeString()
            ->and($data['note'])->toBeString()
            ->and($data['addresses'])->toBeArray()
            ->and($data['primary_address'])->toBeArray()
            ->and($data['stats'])->toBeArray()
            ->and($data['tags'])->toBeArray()
            ->and($data['custom_fields'])->toBeArray()
            ->and($data['external_ids'])->toBeArray()
            ->and($data['is_email_subscribed'])->toBeBool()
            ->and($data['is_phone_subscribed'])->toBeBool()
            ->and($data['is_address_subscribed'])->toBeBool()
            ->and($data['address_unsubscribed_at'])->toBeString()
            ->and($data['archived_at'])->toBeString()
            ->and($data['created_at'])->toBeString()
            ->and($data['updated_at'])->toBeString()
            ->and($data['preferred_name'])->toBeString()
            ->and($data['salutation_name'])->toBeString()
            ->and($data['message'])->toBeNull()
            ->and($data['errors'])->toBeNull();
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
    })->skip('TODO: Allow for overrides to apply to missing fields');

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetContactResponse::fake(GetContactFixture::class, [
            'company' => 'Dunder Mifflin',
        ]);

        // Assert
        expect($fake)->toBeContact()
            ->company->toBe('Dunder Mifflin');
    });

    it('handles null coalesced fields', function (): void {
        // Arrange
        $data = GetContactFixture::data();
        $data['dob'] = null;
        $data['primary_address'] = null;
        $data['stats'] = null;
        $data['address_unsubscribed_at'] = null;
        $data['archived_at'] = null;
        $data['created_at'] = null;
        $data['updated_at'] = null;

        // Act
        $response = GetContactResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response)->toBeInstanceOf(GetContactResponse::class)
            ->dob->toBeNull()
            ->primaryAddress->toBeNull()
            ->stats->toBeNull()
            ->addressUnsubscribedAt->toBeNull()
            ->archivedAt->toBeNull()
            ->createdAt->toBeNull()
            ->updatedAt->toBeNull();

        expect($arrayData)->toBeArray()
            ->and($arrayData['dob'])->toBeNull()
            ->and($arrayData['primary_address'])->toBeNull()
            ->and($arrayData['stats'])->toBeNull()
            ->and($arrayData['address_unsubscribed_at'])->toBeNull()
            ->and($arrayData['archived_at'])->toBeNull()
            ->and($arrayData['created_at'])->toBeNull()
            ->and($arrayData['updated_at'])->toBeNull();
    });
});
