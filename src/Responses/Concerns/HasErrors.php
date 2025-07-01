<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

/**
 * @property-read ?array<string, string[]> $errors
 */
trait HasErrors
{
    use HasErrorMessaging;

    public function hasErrors(): bool
    {
        return $this->errors !== null && count($this->errors) > 0;
    }
}
