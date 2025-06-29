<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Carbon\CarbonImmutable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type AddressSchema array{
 *     id: int,
 *     account_id: int,
 *     name: string,
 *     address_1: string,
 *     address_2: string,
 *     city: string,
 *     state: string,
 *     zipcode: string,
 *     country: string,
 *     type: string,
 *     is_primary: bool,
 *     created_at: string,
 *     updated_at: string,
 * }
 *
 * @implements ResponseContract<AddressSchema>
 */
final readonly class Address implements ResponseContract
{
    /**
     * @use ArrayAccessible<AddressSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public int $id,
        public int $accountId,
        public string $name,
        public string $address1,
        public string $address2,
        public string $city,
        public string $state,
        public string $zipCode,
        public string $country,
        public string $type,
        public bool $isPrimary,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $updatedAt,
    ) {
        //
    }

    /**
     * @param  AddressSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['account_id'],
            $attributes['name'],
            $attributes['address_1'],
            $attributes['address_2'],
            $attributes['city'],
            $attributes['state'],
            $attributes['zipcode'],
            $attributes['country'],
            $attributes['type'],
            $attributes['is_primary'],
            CarbonImmutable::parse($attributes['created_at']),
            CarbonImmutable::parse($attributes['updated_at']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'account_id' => $this->accountId,
            'name' => $this->name,
            'address_1' => $this->address1,
            'address_2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipCode,
            'country' => $this->country,
            'type' => $this->type,
            'is_primary' => $this->isPrimary,
            'created_at' => $this->createdAt->toIso8601String(),
            'updated_at' => $this->updatedAt->toIso8601String(),
        ];
    }
}
