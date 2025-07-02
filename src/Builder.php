<?php

declare(strict_types=1);

namespace Givebutter;

use Givebutter\Exceptions\GivebutterClientException;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Http\Connector;
use Wrapkit\Http\Handlers\JsonResponseHandler;
use Wrapkit\ValueObjects\BaseUri;
use Wrapkit\ValueObjects\Headers;
use Wrapkit\ValueObjects\QueryParams;

final class Builder
{
    public private(set) ?ClientInterface $httpClient = null;

    /**
     * @var array<string, string>
     */
    public private(set) array $headers = [];

    /**
     * @var array<string, string|int>
     */
    public private(set) array $queryParams = [];

    public private(set) ?string $apiKey = null;

    public private(set) ?ConnectorContract $connector = null;

    public private(set) ?string $baseUri = null;

    public function withHttpClient(ClientInterface $client): self
    {
        $clone = clone $this;
        $clone->httpClient = $client;

        return $clone;
    }

    public function withHeader(string $name, string $value): self
    {
        $clone = clone $this;
        $clone->headers[$name] = $value;

        return $clone;
    }

    public function withQueryParam(string $name, string $value): self
    {
        $clone = clone $this;
        $clone->queryParams[$name] = $value;

        return $clone;
    }

    public function withApiKey(string $apiKey): self
    {
        $clone = clone $this;
        $clone->apiKey = $apiKey;

        return $clone;
    }

    public function withBaseUri(string $baseUri): self
    {
        $clone = clone $this;
        $clone->baseUri = $baseUri;

        return $clone;
    }

    /**
     * @throws GivebutterClientException
     */
    public function build(): Client
    {
        if ($this->apiKey === null) {
            throw GivebutterClientException::apiKeyMissing();
        }

        $headers = Headers::create();

        // For any default headers configured for the client, we'll add those to each outbound request
        foreach ($this->headers as $name => $value) {
            $headers = $headers->withCustomHeader($name, $value);
        }

        // Add the API key as a default header to be included on every request
        $headers = $headers->withCustomHeader('Authorization', "Bearer $this->apiKey");
        $baseUri = BaseUri::from($this->baseUri ?? Client::API_BASE_URL);
        $queryParams = QueryParams::create();

        // As with the headers, we'll also include any query params configured on each request
        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }

        if (!$this->httpClient instanceof ClientInterface) {
            $this->httpClient = Psr18ClientDiscovery::find();
        }

        $client = $this->httpClient;
        $this->connector = new Connector($client, $baseUri, $headers, $queryParams, new JsonResponseHandler);

        return new Client($this->connector);
    }
}
