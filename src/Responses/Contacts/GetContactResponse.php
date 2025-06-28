<?php

declare(strict_types=1);

namespace Givebutter\Responses\Contacts;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Models\ContactMeta;
use Givebutter\Responses\Models\Stats;
use PharIo\Manifest\Email;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type ContactMetaSchema from ContactMeta
 * @phpstan-import-type StatsSchema from Stats
 *
 * @phpstan-type GetContactResponseSchema array{
 *     id: int,
 *     first_name: string,
 *     middle_name: ?string,
 *     last_name: string,
 *     dob: string,
 *     company: string,
 *     title: string,
 *     twitter_url: ?string,
 *     linkedin_url: ?string,
 *     facebook_url: ?string,
 *     emails: ContactMetaSchema[],
 *     phones: ContactMetaSchema[],
 *     primary_email: string,
 *     primary_phone: string,
 *     note: string,
 *     addresses: AddressSchema[],
 *     primary_address: AddressSchema,
 *     stats: StatsSchema,
 *     tags: string[],
 *     archived_at: string,
 *     created_at: string,
 *     updated_at: string,
 * }
 *
 * @implements ResponseContract<GetContactResponseSchema>
 */
final readonly class GetContactResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetContactResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetContactResponseSchema>
     */
    use Fakeable;

    /**
     * @param  ContactMeta[]  $emails
     * @param  ContactMeta[]  $phones
     * @param  Address[]  $addresses
     * @param  string[]  $tags
     */
    public function __construct(
        public int $id,
        public string $firstName,
        public ?string $middleName,
        public string $lastName,
        public CarbonImmutable $dob,
        public string $company,
        public string $title,
        public ?string $twitterUrl,
        public ?string $linkedInUrl,
        public ?string $facebookUrl,
        public array $emails,
        public array $phones,
        public string $primaryEmail,
        public string $primaryPhone,
        public string $note,
        public array $addresses,
        public Address $primaryAddress,
        public Stats $stats,
        public array $tags,
        public CarbonImmutable $archivedAt,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $updatedAt,
    ) {
        //
    }

    /**
     * @param  GetContactResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['first_name'],
            $attributes['middle_name'],
            $attributes['last_name'],
            CarbonImmutable::parse($attributes['dob']),
            $attributes['company'],
            $attributes['title'],
            $attributes['twitter_url'],
            $attributes['linkedin_url'],
            $attributes['facebook_url'],
            array_map(static fn (array $email): ContactMeta => ContactMeta::from($email), $attributes['emails']),
            array_map(static fn (array $phone): ContactMeta => ContactMeta::from($phone), $attributes['phones']),
            $attributes['primary_email'],
            $attributes['primary_phone'],
            $attributes['note'],
            array_map(static fn (array $address): Address => Address::from($address), $attributes['addresses']),
            Address::from($attributes['primary_address']),
            Stats::from($attributes['stats']),
            $attributes['tags'],
            CarbonImmutable::parse($attributes['archived_at']),
            CarbonImmutable::parse($attributes['created_at']),
            CarbonImmutable::parse($attributes['updated_at']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'dob' => $this->dob->toIso8601String(),
            'company' => $this->company,
            'title' => $this->title,
            'twitter_url' => $this->twitterUrl,
            'linkedin_url' => $this->linkedInUrl,
            'facebook_url' => $this->facebookUrl,
            'emails' => array_map(static fn (ContactMeta $email): array => $email->toArray(), $this->emails),
            'phones' => array_map(static fn (ContactMeta $address): array => $address->toArray(), $this->phones),
            'primary_email' => $this->primaryEmail,
            'primary_phone' => $this->primaryPhone,
            'note' => $this->note,
            'addresses' => array_map(static fn (Address $address): array => $address->toArray(), $this->addresses),
            'primary_address' => $this->primaryAddress->toArray(),
            'stats' => $this->stats->toArray(),
            'tags' => $this->tags,
            'created_at' => $this->createdAt->toIso8601String(),
            'updated_at' => $this->updatedAt->toIso8601String(),
            'archived_at' => $this->archivedAt->toIso8601String(),
        ];
    }
}
