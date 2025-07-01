<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Givebutter\Testing\Fixtures\Transactions\GetTransactionsFixture;

covers(GetTransactionsResponse::class);

describe(GetTransactionsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetTransactionsFixture::data();
        $this->response = GetTransactionsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetTransactionsResponse::class)
            ->data->toBeArray()->each->toBeInstanceOf(GetTransactionResponse::class)
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
        $fake = GetTransactionsResponse::fake(GetTransactionsFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetTransactionsResponse::class)
            ->data->toBeArray()->each->toBeInstanceOf(GetTransactionResponse::class)
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
