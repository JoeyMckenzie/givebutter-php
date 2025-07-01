<?php

declare(strict_types=1);

use Givebutter\Resources\PayoutsResource;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Payouts\GetPayoutsResponse;
use Givebutter\Testing\Fixtures\Payouts\GetPayoutFixture;
use Givebutter\Testing\Fixtures\Payouts\GetPayoutsFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(PayoutsResource::class);

describe(PayoutsResource::class, function (): void {
    it('can retrieve a single payout', function (): void {
        // Arrange
        $client = ClientMock::get(
            'payouts/abc123',
            Response::from(GetPayoutFixture::data()),
        );

        // Act
        $result = $client->payouts()->get('abc123');

        // Assert
        expect($result)->toBePayout();
    });

    it('can retrieve all tickets', function (): void {
        // Arrange
        $client = ClientMock::get(
            'payouts',
            Response::from(GetPayoutsFixture::data()),
        );

        // Act
        $result = $client->payouts()->list();

        // Assert
        expect($result)->toBeInstanceOf(GetPayoutsResponse::class)
            ->data->each->toBePayout()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
