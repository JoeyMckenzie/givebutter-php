<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

/**
 * @property-read ?string $message
 */
trait HasErrorMessaging
{
    public function hasErrorMessage(): bool
    {
        return $this->message !== null && $this->message !== '';
    }
}
