<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Resources\ContactsResource;
use Givebutter\Responses\Contacts\GetContactResponse;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 *
 * @phpstan-type ContactsResponseSchema GetContactResponseSchema
 */
final class ContactsTestResource implements ContactsResourceContract
{
    /**
     * @use Testable<ContactsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return ContactsResource::class;
        }
    }

    public function get(int $id): GetContactResponse
    {
        /** @var GetContactResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
