<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Givebutter\Resources\TransactionsResource;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Transactions\GetTransactionsResponse;
use Givebutter\Testing\Fixtures\Transactions\GetTransactionFixture;
use Givebutter\Testing\Fixtures\Transactions\GetTransactionsFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

use function Pest\Faker\fake;

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
        expect($result)->toBeTransaction();
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
            ->data->each->toBeTransaction()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });

    it('can retrieve all transactions with a scope', function (): void {
        // Arrange
        $client = ClientMock::get(
            'transactions',
            Response::from(GetTransactionsFixture::data()),
            [
                'scope' => 'test',
            ]
        );

        // Act
        $result = $client->transactions()->list('test');

        // Assert
        expect($result)->toBeInstanceOf(GetTransactionsResponse::class)
            ->data->each->toBeTransaction()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });

    it('can create transactions', function (): void {
        // Arrange
        $payload = [
            'campaign_code' => fake()->text(),
            'campaign_title' => fake()->text(),
            'contact_id' => fake()->numberBetween(1, 100),
            'fund_code' => fake()->text(),
            'first_name' => fake()->text(),
            'last_name' => fake()->text(),
            'email' => fake()->text(),
            'phone' => fake()->text(),
            'address_1' => fake()->text(),
            'address_2' => fake()->text(),
            'city' => fake()->text(),
            'state' => fake()->text(),
            'zipcode' => fake()->text(),
            'country' => fake()->text(),
            'acknowledged_at' => fake()->text(),
            'platform_fee' => fake()->randomFloat(),
            'processing_fee' => fake()->randomFloat(),
            'fee_covered' => fake()->randomFloat(),
            'check_number' => fake()->text(),
            'check_deposited_at' => fake()->text(),
            'external_id' => fake()->text(),
            'external_label' => fake()->text(),
            'amount' => fake()->randomFloat(),
            'method' => 'cash',
            'transacted_at' => CarbonImmutable::now()->addDays(-1)->format('m/d/Y'),
        ];

        $client = ClientMock::post(
            'transactions',
            $payload,
            Response::from(GetTransactionFixture::data()),
        );

        // Act
        $result = $client->transactions()->create($payload);

        // Assert
        expect($result)->toBeTransaction();
    });
});
