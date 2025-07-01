<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

use Givebutter\Responses\Models\Error;

/**
 * @property-read ?Error $errors
 * @property-read ?string $message
 */
trait Fallible
{
    public function hasErrors(): bool
    {
        return $this->errors !== null;
    }
}
