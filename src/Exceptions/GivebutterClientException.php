<?php

declare(strict_types=1);

namespace Givebutter\Exceptions;

use Exception;

final class GivebutterClientException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function apiKeyMissing(): self
    {
        return new self('API key is required to call Givebutter\'s API.');
    }
}
