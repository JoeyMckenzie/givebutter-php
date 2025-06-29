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
        expect($this->response)->toBeTicket();
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
            ->and($data['created_at'])->toBeString();
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
});
