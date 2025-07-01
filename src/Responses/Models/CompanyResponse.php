<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Carbon\CarbonImmutable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 * @phpstan-import-type ContactMetaResponseSchema from ContactMetaResponse
 *
 * @phpstan-type CompanyResponseSchema array{
 *     id: int,
 *     type: string,
 *     company_name: string,
 *     title: ?string,
 *     twitter_url: ?string,
 *     linkedin_url: ?string,
 *     facebook_url: ?string,
 *     website_url: ?string,
 *     emails: ContactMetaResponseSchema[],
 *     phones: ContactMetaResponseSchema[],
 *     primary_email?: ?string,
 *     primary_phone?: ?string,
 *     note: ?string,
 *     addresses: AddressResponseSchema[],
 *     primary_address: ?AddressResponseSchema,
 *     is_email_subscribed: bool,
 *     is_phone_subscribed: bool,
 *     is_address_subscribed: bool,
 *     address_unsubscribed_at: ?string,
 *     archived_at: ?string,
 *     created_at: string,
 *     updated_at: string,
 *     first_time_supporter_at: ?string
 * }
 *
 * @implements ResponseContract<CompanyResponseSchema>
 */
final readonly class CompanyResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<CompanyResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @param  ContactMetaResponse[]  $emails
     * @param  ContactMetaResponse[]  $phones
     * @param  AddressResponse[]  $addresses
     */
    public function __construct(
        public int $id,
        public string $type,
        public string $companyName,
        public ?string $title,
        public ?string $twitterUrl,
        public ?string $linkedinUrl,
        public ?string $facebookUrl,
        public ?string $websiteUrl,
        public array $emails,
        public array $phones,
        public ?string $primaryEmail,
        public ?string $primaryPhone,
        public ?string $note,
        public array $addresses,
        public ?AddressResponse $primaryAddress,
        public bool $isEmailSubscribed,
        public bool $isPhoneSubscribed,
        public bool $isAddressSubscribed,
        public ?CarbonImmutable $addressUnsubscribedAt,
        public ?CarbonImmutable $archivedAt,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $updatedAt,
        public ?CarbonImmutable $firstTimeSupporterAt,
    ) {
        //
    }

    /**
     * @param  CompanyResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'],
            $attributes['company_name'],
            $attributes['title'],
            $attributes['twitter_url'],
            $attributes['linkedin_url'],
            $attributes['facebook_url'],
            $attributes['website_url'],
            array_map(static fn (array $email): ContactMetaResponse => ContactMetaResponse::from($email), $attributes['emails']),
            array_map(static fn (array $phone): ContactMetaResponse => ContactMetaResponse::from($phone), $attributes['phones']),
            $attributes['primary_email'] ?? null,
            $attributes['primary_phone'] ?? null,
            $attributes['note'],
            array_map(static fn (array $address): AddressResponse => AddressResponse::from($address), $attributes['addresses']),
            isset($attributes['primary_address']) ? AddressResponse::from($attributes['primary_address']) : null,
            $attributes['is_email_subscribed'],
            $attributes['is_phone_subscribed'],
            $attributes['is_address_subscribed'],
            isset($attributes['address_unsubscribed_at']) ? CarbonImmutable::parse($attributes['address_unsubscribed_at']) : null,
            isset($attributes['archived_at']) ? CarbonImmutable::parse($attributes['archived_at']) : null,
            CarbonImmutable::parse($attributes['created_at']),
            CarbonImmutable::parse($attributes['updated_at']),
            isset($attributes['first_time_supporter_at']) ? CarbonImmutable::parse($attributes['first_time_supporter_at']) : null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'company_name' => $this->companyName,
            'title' => $this->title,
            'twitter_url' => $this->twitterUrl,
            'linkedin_url' => $this->linkedinUrl,
            'facebook_url' => $this->facebookUrl,
            'website_url' => $this->websiteUrl,
            'emails' => array_map(static fn (ContactMetaResponse $email): array => $email->toArray(), $this->emails),
            'phones' => array_map(static fn (ContactMetaResponse $phone): array => $phone->toArray(), $this->phones),
            'primary_email' => $this->primaryEmail,
            'primary_phone' => $this->primaryPhone,
            'note' => $this->note,
            'addresses' => array_map(static fn (AddressResponse $address): array => $address->toArray(), $this->addresses),
            'primary_address' => $this->primaryAddress?->toArray(),
            'is_email_subscribed' => $this->isEmailSubscribed,
            'is_phone_subscribed' => $this->isPhoneSubscribed,
            'is_address_subscribed' => $this->isAddressSubscribed,
            'address_unsubscribed_at' => $this->addressUnsubscribedAt?->toIso8601String(),
            'archived_at' => $this->archivedAt?->toIso8601String(),
            'created_at' => $this->createdAt->toIso8601String(),
            'updated_at' => $this->updatedAt->toIso8601String(),
            'first_time_supporter_at' => $this->firstTimeSupporterAt?->toIso8601String(),
        ];
    }
}
