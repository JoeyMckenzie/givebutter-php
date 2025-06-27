<?php

declare(strict_types=1);

namespace Givebutter\Resources\Concerns;

use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Resources\ContactsResource;
use Wrapkit\Contracts\ConnectorContract;

/**
 * @property-read ConnectorContract $connector
 */
trait HasContacts
{
    public function contacts(): ContactsResourceContract
    {
        return new ContactsResource($this->connector);
    }
}
