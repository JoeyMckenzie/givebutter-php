<?php

declare(strict_types=1);

namespace Tests;

use Givebutter\Builder;
use Givebutter\Client;
use Givebutter\Givebutter;
use GuzzleHttp\Client as GuzzleClient;
use Wrapkit\ValueObjects\Headers;
use Wrapkit\ValueObjects\QueryParams;

covers(Givebutter::class);

describe(Givebutter::class, function (): void {
    it('creates default client with an API key', function (): void {
        // Arrange & Act
        $client = Givebutter::client('apiKey');

        // Assert
        expect($client)->toBeInstanceOf(Client::class)
            ->and((string) $client->connector->baseUri)->toBe(Client::API_BASE_URL.'/')
            ->and($client->connector->client)->toBeInstanceOf(GuzzleClient::class)
            ->and($client->connector->headers)->toBeInstanceOf(Headers::class)
            ->and($client->connector->headers->hasAnyHeaders())->toBeTrue()
            ->and($client->connector->headers->contains('Authorization'))->toBeTrue()
            ->and($client->connector->headers->contains('User-Agent'))->toBeTrue()
            ->and($client->connector->headers->toArray()['User-Agent'])->toMatch('/^givebutter-php\/\d+\.\d+\.\d+$/')
            ->and($client->connector->queryParams)->toBeInstanceOf(QueryParams::class)
            ->and($client->connector->queryParams->hasAnyParams())->toBeFalse();
    });

    it('creates builder instance', function (): void {
        // Act
        $builder = Givebutter::builder();

        // Assert
        expect($builder)
            ->toBeInstanceOf(Builder::class)
            ->and($builder->headers)->toBe([])
            ->and($builder->queryParams)->toBe([]);
    });

    it('maintains builder customizations', function (): void {
        // Act
        $client = Givebutter::builder()
            ->withApiKey('apiKey')
            ->withHeader('X-Custom', 'value')
            ->withQueryParam('test', 'value')
            ->withHeader('User-Agent', 'givebutter-php-client/1.0.0')
            ->build();

        // Assert
        $headers = $client->connector->headers->toArray();
        expect($headers)
            ->toHaveKey('X-Custom')
            ->toHaveKey('User-Agent')
            ->and($headers['X-Custom'])->toBe('value');

        // Verify query params
        $params = $client->connector->queryParams->toArray();
        expect($params)->toHaveKey('test')
            ->and($params['test'])->toBe('value');

        // Verify API endpoint
        expect((string) $client->connector->baseUri)->toBe(Client::API_BASE_URL.'/');
    });
});
