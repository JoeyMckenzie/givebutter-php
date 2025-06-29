<?php

declare(strict_types=1);

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

    it('can retrieve all campaigns with a scope', function (): void {
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
});
