<?php

declare(strict_types=1);

namespace Tests\Exceptions;

use Exception;
use Givebutter\Exceptions\GivebutterClientException;

covers(GivebutterClientException::class);

describe(GivebutterClientException::class, function (): void {
    it('creates an exception for API keys missing', function (): void {
        // Arrange & Act
        $exception = GivebutterClientException::apiKeyMissing();

        // Assert
        expect($exception)
            ->getMessage()->toBe("API key is required to call Givebutter's API.")
            ->and($exception)->toBeInstanceOf(Exception::class);
    });
});
