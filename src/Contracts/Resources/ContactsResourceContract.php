<?php

declare(strict_types=1);

namespace Givebutter\Contracts\Resources;

use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Contacts\GetContactsResponse;
use Wrapkit\Contracts\ResourceContract;

/**
 * @phpstan-type CreateContactSchema array{
 *     first_name: string,
 *     middle_name?: string,
 *     last_name: string,
 *     emails?: array<int, array{
 *         type: string,
 *         value: string,
 *     }>,
 *     phones?: array<int, array{
 *         type: string,
 *         value: string,
 *     }>,
 *     addresses?: array<int, array{
 *         address_1: string,
 *         address_2?: string,
 *         city: string,
 *         state: string,
 *         zipcode: string,
 *         country: string,
 *     }>,
 *     tags?: string[],
 *     dob?: string,
 *     company?: string,
 *     title?: string,
 *     twitter_url?: string,
 *     linkedin_url?: string,
 *     facebook_url?: string,
 * }
 */
interface ContactsResourceContract extends ResourceContract
{
    public function get(int $id): GetContactResponse;

    public function list(?string $scope = null): GetContactsResponse;

    /**
     * @param  CreateContactSchema  $params
     */
    public function create(array $params, bool $forceCreate = false): GetContactResponse;
}
