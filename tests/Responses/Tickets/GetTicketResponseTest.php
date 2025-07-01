<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Tickets\GetTicketResponse;
use Givebutter\Testing\Fixtures\Tickets\GetTicketFixture;

covers(GetTicketResponse::class);

describe(GetTicketResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetTicketFixture::data();
        $this->response = GetTicketResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeTicket()
            ->and($this->response->hasErrorMessage())->toBeFalse();
    });

    it('can contain errors', function (): void {
        // Arrange
        $errors = GetTicketFixture::errors();

        // Act
        $response = GetTicketResponse::from($errors);

        expect($response)->toBeTicketWithErrors()
            ->and($response->hasErrorMessage())->toBeTrue();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeString()
            ->and($data['id_suffix'])->toBeString()
            ->and($data['name'])->toBeString()
            ->and($data['first_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['email'])->toBeString()
            ->and($data['phone'])->toBeString()
            ->and($data['title'])->toBeString()
            ->and($data['description'])->toBeString()
            ->and($data['price'])->toBeInt()
            ->and($data['pdf'])->toBeString()
            ->and($data['arrived_at'])->toBeString()
            ->and($data['created_at'])->toBeString()
            ->and($data['message'])->toBeNull();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetTicketResponse::fake(GetTicketFixture::class);

        // Assert

        expect($fake)->toBeTicket();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetTicketResponse::fake(GetTicketFixture::class, [
            'description' => 'ticket description',
        ]);

        // Assert
        expect($fake)->toBeTicket()
            ->description->toBe('ticket description');
    });

    it('handles null coalesced fields correctly', function (): void {
        // Arrange
        $data = GetTicketFixture::data();
        $data['arrived_at'] = null;
        $data['created_at'] = null;

        // Act
        $response = GetTicketResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response)->toBeInstanceOf(GetTicketResponse::class)
            ->arrivedAt->toBeNull()
            ->createdAt->toBeNull();

        expect($arrayData)->toBeArray()
            ->and($arrayData['arrived_at'])->toBeNull()
            ->and($arrayData['created_at'])->toBeNull();
    });
});
