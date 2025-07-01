<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Tickets\GetTicketsResponse;
use Givebutter\Testing\Fixtures\Tickets\GetTicketsFixture;

covers(GetTicketsResponse::class);

describe(GetTicketsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetTicketsFixture::data();
        $this->response = GetTicketsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetTicketsResponse::class)
            ->data->toBeArray()->each->toBeTicket()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['data'])->toBeArray()
            ->and($data['meta'])->toBeArray()
            ->and($data['links'])->toBeArray();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetTicketsResponse::fake(GetTicketsFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetTicketsResponse::class)
            ->data->toBeArray()->each->toBeTicket()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
