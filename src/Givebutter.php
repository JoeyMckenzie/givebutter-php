<?php

declare(strict_types=1);

namespace Givebutter;

use Givebutter\Exceptions\ApiClientException;

final class Givebutter
{
    /**
     * Creates a new default client instance.
     *
     * @throws ApiClientException
     */
    public static function client(string $apiKey): Client
    {
        return self::builder()
            ->withHeader('User-Agent', 'givebutter-php-client/0.1.0')
            ->withApiKey($apiKey)
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
