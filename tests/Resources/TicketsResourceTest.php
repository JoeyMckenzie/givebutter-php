<?php

declare(strict_types=1);

use Givebutter\Resources\TicketsResource;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Tickets\GetTicketsResponse;
use Givebutter\Testing\Fixtures\Tickets\GetTicketFixture;
use Givebutter\Testing\Fixtures\Tickets\GetTicketsFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(TicketsResource::class);

describe(TicketsResource::class, function (): void {
    it('can retrieve a single ticket', function (): void {
        // Arrange
        $client = ClientMock::get(
            'tickets/abc123',
            Response::from(GetTicketFixture::data()),
        );

        // Act
        $result = $client->tickets()->get('abc123');

        // Assert
        expect($result)->toBeTicket();
    });

    it('can retrieve all tickets', function (): void {
        // Arrange
        $client = ClientMock::get(
            'tickets',
            Response::from(GetTicketsFixture::data()),
        );

        // Act
        $result = $client->tickets()->list();

        // Assert
        expect($result)->toBeInstanceOf(GetTicketsResponse::class)
            ->data->each->toBeTicket()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
