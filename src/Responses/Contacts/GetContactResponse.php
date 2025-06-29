<?php

declare(strict_types=1);

namespace Givebutter\Responses\Contacts;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Models\Company;
use Givebutter\Responses\Models\ContactMeta;
use Givebutter\Responses\Models\CustomField;
use Givebutter\Responses\Models\Stats;
use PharIo\Manifest\Email;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type AddressSchema from Address
 * @phpstan-import-type CompanySchema from Company
 * @phpstan-import-type ContactMetaSchema from ContactMeta
 * @phpstan-import-type CustomFieldSchema from CustomField
 * @phpstan-import-type StatsSchema from Stats
 *
 * @phpstan-type GetContactResponseSchema array{
 *     id: int,
 *     type: string,
 *     prefix: ?string,
 *     first_name: string,
 *     middle_name: ?string,
 *     last_name: string,
 *     suffix: ?string,
 *     gender: ?string,
 *     dob: ?string,
 *     company: ?string,
 *     company_name: ?string,
 *     employer: ?string,
 *     point_of_contact: ?string,
 *     associated_companies: CompanySchema[],
 *     title: ?string,
 *     twitter_url: ?string,
 *     linkedin_url: ?string,
 *     facebook_url: ?string,
 *     website_url: ?string,
 *     emails: ContactMetaSchema[],
 *     phones: ContactMetaSchema[],
 *     primary_email: string,
 *     primary_phone: string,
 *     note: ?string,
 *     addresses: AddressSchema[],
 *     primary_address: AddressSchema,
 *     stats: StatsSchema,
 *     tags: string[],
 *     custom_fields: CustomFieldSchema[],
 *     external_ids: int[],
 *     is_email_subscribed: bool,
 *     is_phone_subscribed: bool,
 *     is_address_subscribed: bool,
 *     address_unsubscribed_at: ?string,
 *     archived_at: ?string,
 *     created_at: string,
 *     updated_at: string,
 *     preferred_name: ?string,
 *     salutation_name: string,
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
     * @param  Company[]  $associatedCompanies
     * @param  ContactMeta[]  $emails
     * @param  ContactMeta[]  $phones
     * @param  Address[]  $addresses
     * @param  string[]  $tags
     * @param  CustomField[]  $customFields
     * @param  int[]  $externalIds
     */
    public function __construct(
        public int $id,
        public string $type,
        public ?string $prefix,
        public string $firstName,
        public ?string $middleName,
        public string $lastName,
        public ?string $suffix,
        public ?string $gender,
        public ?CarbonImmutable $dob,
        public ?string $company,
        public ?string $companyName,
        public ?string $employer,
        public ?string $pointOfContact,
        public array $associatedCompanies,
        public ?string $title,
        public ?string $twitterUrl,
        public ?string $linkedInUrl,
        public ?string $facebookUrl,
        public ?string $websiteUrl,
        public array $emails,
        public array $phones,
        public string $primaryEmail,
        public string $primaryPhone,
        public ?string $note,
        public array $addresses,
        public Address $primaryAddress,
        public Stats $stats,
        public array $tags,
        public array $customFields,
        public array $externalIds,
        public bool $isEmailSubscribed,
        public bool $isPhoneSubscribed,
        public bool $isAddressSubscribed,
        public ?CarbonImmutable $addressUnsubscribedAt,
        public ?CarbonImmutable $archivedAt,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $updatedAt,
        public ?string $preferredName,
        public string $salutationName,
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
            $attributes['type'],
            $attributes['prefix'],
            $attributes['first_name'],
            $attributes['middle_name'],
            $attributes['last_name'],
            $attributes['suffix'],
            $attributes['gender'],
            isset($attributes['dob']) ? CarbonImmutable::parse($attributes['dob']) : null,
            $attributes['company'],
            $attributes['company_name'],
            $attributes['employer'],
            $attributes['point_of_contact'],
            array_map(static fn (array $company): Company => Company::from($company), $attributes['associated_companies']),
            $attributes['title'],
            $attributes['twitter_url'],
            $attributes['linkedin_url'],
            $attributes['facebook_url'],
            $attributes['website_url'],
            array_map(static fn (array $email): ContactMeta => ContactMeta::from($email), $attributes['emails']),
            array_map(static fn (array $phone): ContactMeta => ContactMeta::from($phone), $attributes['phones']),
            $attributes['primary_email'],
            $attributes['primary_phone'],
            $attributes['note'],
            array_map(static fn (array $address): Address => Address::from($address), $attributes['addresses']),
            Address::from($attributes['primary_address']),
            Stats::from($attributes['stats']),
            $attributes['tags'],
            array_map(static fn (array $field): CustomField => CustomField::from($field), $attributes['custom_fields']),
            $attributes['external_ids'],
            $attributes['is_email_subscribed'],
            $attributes['is_phone_subscribed'],
            $attributes['is_address_subscribed'],
            isset($attributes['address_unsubscribed_at']) ? CarbonImmutable::parse($attributes['address_unsubscribed_at']) : null,
            isset($attributes['archived_at']) ? CarbonImmutable::parse($attributes['archived_at']) : null,
            CarbonImmutable::parse($attributes['created_at']),
            CarbonImmutable::parse($attributes['updated_at']),
            $attributes['preferred_name'],
            $attributes['salutation_name'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'prefix' => $this->prefix,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'suffix' => $this->suffix,
            'gender' => $this->gender,
            'dob' => $this->dob?->toIso8601String(),
            'company' => $this->company,
            'company_name' => $this->companyName,
            'employer' => $this->employer,
            'point_of_contact' => $this->pointOfContact,
            'associated_companies' => array_map(static fn (Company $company): array => $company->toArray(), $this->associatedCompanies),
            'title' => $this->title,
            'twitter_url' => $this->twitterUrl,
            'linkedin_url' => $this->linkedInUrl,
            'facebook_url' => $this->facebookUrl,
            'website_url' => $this->websiteUrl,
            'emails' => array_map(static fn (ContactMeta $email): array => $email->toArray(), $this->emails),
            'phones' => array_map(static fn (ContactMeta $address): array => $address->toArray(), $this->phones),
            'primary_email' => $this->primaryEmail,
            'primary_phone' => $this->primaryPhone,
            'note' => $this->note,
            'addresses' => array_map(static fn (Address $address): array => $address->toArray(), $this->addresses),
            'primary_address' => $this->primaryAddress->toArray(),
            'stats' => $this->stats->toArray(),
            'tags' => $this->tags,
            'custom_fields' => array_map(static fn (CustomField $field): array => $field->toArray(), $this->customFields),
            'external_ids' => $this->externalIds,
            'is_email_subscribed' => $this->isEmailSubscribed,
            'is_phone_subscribed' => $this->isPhoneSubscribed,
            'is_address_subscribed' => $this->isAddressSubscribed,
            'address_unsubscribed_at' => $this->addressUnsubscribedAt?->toIso8601String(),
            'archived_at' => $this->archivedAt?->toIso8601String(),
            'created_at' => $this->createdAt->toIso8601String(),
            'updated_at' => $this->updatedAt->toIso8601String(),
            'preferred_name' => $this->preferredName,
            'salutation_name' => $this->salutationName,
        ];
    }
}
