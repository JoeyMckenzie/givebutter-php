<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Contacts\GetContactsResponse;
use Wrapkit\Contracts\ResourceContract;

interface ContactsResourceContract extends ResourceContract
{
    public function get(int $id): GetContactResponse;

    public function list(?string $scope = null): GetContactsResponse;
}
