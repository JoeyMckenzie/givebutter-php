<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\ContactsResourceContract;
use Wrapkit\Contracts\ConnectorContract;

final class ContactsResource implements ContactsResourceContract
{
    public string $resource {
        get {
            return 'contacts';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
