<?php

declare(strict_types=1);

namespace Tests\Mocks;

use Givebutter\Client;
use JsonException;
use Mockery;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Enums\HttpMethod;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

final class ClientMock
{
    /**
     * @param  array<string, array-key>  $params
     * @param  array<string, string>  $additionalHeaders
     */
    public static function post(
        string $resource,
        array $params,
        Response|ResponseInterface|string|null $response,
        array $queryParams = [],
        bool $validateParams = true,
    ): Client {
        return self::create(HttpMethod::POST, $resource, $params, $response, $queryParams, $validateParams);
    }

    /**
     * @param  array<string, array-key>  $params
     * @param  array<string, string>  $additionalHeaders
     */
    public static function create(
        HttpMethod $method,
        string $resource,
        array $params,
        Response|ResponseInterface|string|null $response,
        array $queryParams = [],
        bool $validateParams = true,
        string $methodName = 'sendClientRequest'
    ): Client {
        $connector = Mockery::mock(ConnectorContract::class);
        $connector
            ->shouldReceive($methodName)
            ->once()
            ->withArgs(fn (ClientRequestBuilder $requestBuilder): bool => self::validateRequest($requestBuilder, $method, $resource, $params, $queryParams, $validateParams))
            ->andReturn($response);

        return new Client($connector);
    }

    /**
     * @param  array<string, array-key>  $params
     * @param  array<string, string>  $additionalHeaders
     */
    public static function patch(
        string $resource,
        array $params,
        Response|ResponseInterface|string|null $response,
        bool $validateParams = true,
    ): Client {
        return self::create(HttpMethod::PATCH, $resource, $params, $response, validateParams: $validateParams);
    }

    /**
     * @param  array<string, array-key>  $params
     * @param  array<string, string>  $additionalHeaders
     */
    public static function delete(
        string $resource,
        Response|ResponseInterface|string|null $response,
        bool $validateParams = true,
        string $methodName = 'sendClientRequest'
    ): Client {
        return self::create(HttpMethod::DELETE, $resource, [], $response, [], $validateParams, $methodName);
    }

    public static function get(
        string $resource,
        Response|ResponseInterface|string $response,
        array $params = [],
        bool $validateParams = true
    ): Client {
        return self::create(HttpMethod::GET, $resource, $params, $response, validateParams: $validateParams);
    }

    /**
     * @param  array<string, mixed>  $params
     * @param  array<string, mixed>  $queryParams
     *
     * @throws JsonException
     */
    private static function validateRequest(
        ClientRequestBuilder $requestBuilder,
        HttpMethod $method,
        string $resource,
        array $params,
        array $queryParams,
        bool $validateParams
    ): bool {
        $request = $requestBuilder->build();

        if (! self::validateRequestBasics($request, $method, $resource)) {
            return false;
        }

        if (! $validateParams) {
            return true;
        }

        return match ($method) {
            HttpMethod::GET => self::validateParams($request, $params),
            HttpMethod::DELETE => self::validateParams($request, $params),
            HttpMethod::POST => self::validateRequestBody($request, $params, $queryParams),
            HttpMethod::PATCH => self::validateRequestBody($request, $params, $queryParams),
        };
    }

    private static function validateRequestBasics(RequestInterface $request, HttpMethod $method, string $resource): bool
    {
        $path = $request->getUri()->getPath();
        $requestMethod = $request->getMethod();

        return $requestMethod === $method->value && $path === $resource;
    }

    /**
     * @param  array<string, string>  $params
     */
    private static function validateParams(RequestInterface $request, array $params): bool
    {
        $query = $request->getUri()->getQuery();
        $expectedQuery = http_build_query($params);

        return $query === $expectedQuery;
    }

    /**
     * @param  array<array-key, mixed>  $params
     * @param  array<array-key, mixed>  $queryParams
     */
    private static function validateRequestBody(RequestInterface $request, array $params, array $queryParams): bool
    {
        $requestContents = $request->getBody()->getContents();
        $requestArray = json_decode($requestContents, true);
        $paramsArray = json_decode(json_encode($params), true);
        $queryValidated = true;

        if (count($queryParams) > 0) {
            $queryValidated = self::validateParams($request, $queryParams);
        }

        return $queryValidated && self::compareArraysRecursively($requestArray, $paramsArray);
    }

    /**
     * Recursively compares two arrays ignoring the order of keys
     *
     * @param  array<array-key, mixed>  $array1
     * @param  array<array-key, mixed>  $array2
     */
    private static function compareArraysRecursively(array $array1, array $array2): bool
    {
        if (count($array1) !== count($array2)) {
            return false;
        }

        foreach ($array1 as $key => $value) {
            if (! array_key_exists($key, $array2)) {
                return false;
            }

            if (is_array($value) && is_array($array2[$key])) {
                if (! self::compareArraysRecursively($value, $array2[$key])) {
                    return false;
                }

                continue;
            }

            if ($value !== $array2[$key]) {
                return false;
            }
        }

        return true;
    }
}
