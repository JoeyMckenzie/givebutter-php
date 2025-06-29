<?php

declare(strict_types=1);

use Givebutter\Resources\ContactsResource;
use Givebutter\Testing\Fixtures\Contacts\GetContactFixture;
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
});
