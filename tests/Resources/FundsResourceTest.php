<?php

declare(strict_types=1);

use Givebutter\Resources\FundsResource;
use Givebutter\Testing\Fixtures\Funds\GetFundFixture;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;
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

    it('can create a fund', function (): void {
        // Arrange
        $client = ClientMock::post(
            'funds',
            [
                'name' => "Scott's Tots",
                'code' => null,
            ],
            Response::from(GetFundFixture::data()),
        );

        // Act
        $result = $client->funds()->create("Scott's Tots");

        // Assert
        expect($result)->toBeFund();
    });

    it('can create a fund with a code', function (): void {
        // Arrange
        $client = ClientMock::post(
            'funds',
            [
                'name' => "Scott's Tots",
                'code' => 'ST',
            ],
            Response::from(GetFundFixture::data()),
        );

        // Act
        $result = $client->funds()->create("Scott's Tots", 'ST');

        // Assert
        expect($result)->toBeFund();
    });

    it('can create a fund with errors', function (): void {
        // Arrange
        $client = ClientMock::post(
            'funds',
            [
                'name' => "Scott's Tots",
                'code' => null,
            ],
            Response::from(GetFundFixture::errors()),
        );

        // Act
        $result = $client->funds()->create("Scott's Tots");

        // Assert
        expect($result)->toBeFallibleFund();
    });

    it('can update a fund', function (): void {
        // Arrange
        $client = ClientMock::patch(
            'funds/abc123',
            [
                'name' => "Scott's Tots",
                'code' => null,
            ],
            Response::from(GetFundFixture::data()),
        );

        // Act
        $result = $client->funds()->update('abc123', "Scott's Tots");

        // Assert
        expect($result)->toBeFund();
    });

    it('can update a fund with a code', function (): void {
        // Arrange
        $client = ClientMock::patch(
            'funds/abc123',
            [
                'name' => "Scott's Tots",
                'code' => 'ST',
            ],
            Response::from(GetFundFixture::data()),
        );

        // Act
        $result = $client->funds()->update('abc123', "Scott's Tots", 'ST');

        // Assert
        expect($result)->toBeFund();
    });

    it('can update a fund with errors', function (): void {
        // Arrange
        $client = ClientMock::patch(
            'funds/abc123',
            [
                'name' => "Scott's Tots",
                'code' => null,
            ],
            Response::from(GetFundFixture::errors()),
        );

        // Act
        $result = $client->funds()->update('abc123', "Scott's Tots");

        // Assert
        expect($result)->toBeFallibleFund();
    });

    it('can delete a fund', function (): void {
        // Arrange
        $client = ClientMock::delete(
            'funds/abc123',
            new GuzzleResponse(200),
            methodName: 'sendStandardClientRequest'
        );

        // Act
        $result = $client->funds()->delete('abc123');

        // Assert
        expect($result)->toBeInstanceOf(ResponseInterface::class)
            ->and($result->getStatusCode())->toBe(200);
    });
});
