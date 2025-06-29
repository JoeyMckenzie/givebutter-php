<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Contacts\GetContactResponse;
use Wrapkit\Contracts\ResourceContract;

interface ContactsResourceContract extends ResourceContract
{
    public function get(int $id): GetContactResponse;
}
