<?php

declare(strict_types=1);

namespace Givebutter\Responses\Concerns;

use Givebutter\Responses\Models\Error;

trait Fallible
{
    public Error $error {
        get {
            return $this->error;
        }
    }
}
