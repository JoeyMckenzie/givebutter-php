<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

use Givebutter\Responses\Models\Errors;

/**
 * @property-read ?Errors $errors
 * @property-read ?string $message
 */
trait Fallible
{
    public function hasError(): bool
    {
        return $this->errors !== null;
    }
}
