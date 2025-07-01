<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

use Givebutter\Responses\Models\ErrorResponse;

/**
 * @property-read ?ErrorResponse $errors
 * @property-read ?string $message
 */
trait Fallible
{
    public function hasErrors(): bool
    {
        return $this->errors !== null;
    }
}
