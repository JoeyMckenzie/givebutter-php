<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

use Givebutter\Responses\Models\Errors;

trait Fallible
{
    public ?Errors $error = null {
        get {
            return $this->error;
        }
    }

    public ?string $message = null {
        get {
            return $this->message;
        }
    }

    public function hasError(): bool
    {
        return $this->error !== null;
    }
}
