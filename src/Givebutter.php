<?php

declare(strict_types=1);

namespace Givebutter;

use Givebutter\Exceptions\GivebutterClientException;

final class Givebutter
{
    /**
     * Creates a new default client instance.
     *
     * @throws GivebutterClientException
     */
    public static function client(string $apiKey): Client
    {
        return self::builder()
            ->withHeader('User-Agent', 'givebutter-php/0.1.3')
            ->withApiKey($apiKey)
            ->withBaseUri(Client::API_BASE_URL)
            ->build();
    }

    /**
     * Creates a new client builder to configure with custom options.
     */
    public static function builder(): Builder
    {
        return new Builder;
    }
}
