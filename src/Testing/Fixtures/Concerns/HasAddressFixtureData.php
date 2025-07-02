<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Concerns;

use Givebutter\Responses\Models\AddressResponse;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 */
trait HasAddressFixtureData
{
    /**
     * @return AddressResponseSchema
     */
    public static function address(): array
    {
        /** @var AddressResponseSchema $data */
        $data = [
            'id' => 123,
            'account_id' => 456,
            'name' => 'Home Address',
            'address_1' => '123 Main St',
            'address_2' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zipcode' => '10001',
            'country' => 'United States',
            'type' => 'residential',
            'is_primary' => true,
            'created_at' => '2023-01-15T14:30:45+00:00',
            'updated_at' => '2023-01-15T14:30:45+00:00',
        ];

        return $data;
    }
}
