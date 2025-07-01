<?php

declare(strict_types=1);

use Givebutter\Resources\FundsResource;
use Givebutter\Testing\Fixtures\Funds\GetFundFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(FundsResource::class);

describe(FundsResource::class, function (): void {
    it('can retrieve a single fund', function (): void {
        // Arrange
        $client = ClientMock::get(
            'funds/abc123',
            Response::from(GetFundFixture::data()),
        );

        // Act
        $result = $client->funds()->get('abc123');

        // Assert
        expect($result)->toBeFund();
    });

    it('can retrieve a single fund with errors', function (): void {
        // Arrange
        $client = ClientMock::get(
            'funds/abc123',
            Response::from(GetFundFixture::errors()),
        );

        // Act
        $result = $client->funds()->get('abc123');

        // Assert
        expect($result)->toBeFallibleFund();
    });
});
