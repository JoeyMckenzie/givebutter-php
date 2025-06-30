<?php

declare(strict_types=1);

use Givebutter\Resources\TransactionsResource;
use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Givebutter\Testing\Fixtures\Transactions\GetTransactionFixture;
use Givebutter\Testing\Fixtures\Transactions\GetTransactionsFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(TransactionsResource::class);

describe(TransactionsResource::class, function (): void {
    it('can retrieve a single transaction', function (): void {
        // Arrange
        $client = ClientMock::get(
            'transactions/abc123',
            Response::from(GetTransactionFixture::data()),
        );

        // Act
        $result = $client->transactions()->get('abc123');

        // Assert
        expect($result)->toBeTransactionResponse();
    });

    it('can retrieve all transactions', function (): void {
        // Arrange
        $client = ClientMock::get(
            'transactions',
            Response::from(GetTransactionsFixture::data()),
        );

        // Act
        $result = $client->transactions()->list();

        // Assert
        expect($result)->toBeInstanceOf(GetTransactionsResponse::class)
            ->data->each->toBeTransactionResponse()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
    });
});
