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
            ->and($data['first_name'])->toBeString()
            ->and($data['middle_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['dob'])->toBeString()
            ->and($data['company'])->toBeString()
            ->and($data['title'])->toBeString()
            ->and($data['twitter_url'])->toBeString()
            ->and($data['linkedin_url'])->toBeString()
            ->and($data['facebook_url'])->toBeString()
            ->and($data['emails'])->toBeArray()
            ->and($data['phones'])->tobeArray()
            ->and($data['primary_email'])->toBeString()
            ->and($data['primary_phone'])->toBeString()
            ->and($data['note'])->toBeString()
            ->and($data['addresses'])->toBeArray()
            ->and($data['primary_address'])->toBeArray()
            ->and($data['stats'])->toBeArray()
            ->and($data['tags'])->toBeArray()
            ->and($data['created_at'])->toBeString()
            ->and($data['updated_at'])->toBeString()
            ->and($data['archived_at'])->toBeString();
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
