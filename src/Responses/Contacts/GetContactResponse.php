<?php

declare(strict_types=1);

namespace Givebutter\Responses\Contacts;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Concerns\HasErrors;
use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Models\CompanyResponse;
use Givebutter\Responses\Models\ContactMetaResponse;
use Givebutter\Responses\Models\CustomFieldResponse;
use Givebutter\Responses\Models\StatsResponse;
use PharIo\Manifest\Email;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type AddressResponseSchema from AddressResponse
 * @phpstan-import-type CompanyResponseSchema from CompanyResponse
 * @phpstan-import-type ContactMetaResponseSchema from ContactMetaResponse
 * @phpstan-import-type CustomFieldResponseSchema from CustomFieldResponse
 * @phpstan-import-type StatsResponseSchema from StatsResponse
 *
 * @phpstan-type GetContactResponseSchema array{
 *     id?: ?int,
 *     type?: ?string,
 *     prefix?: ?string,
 *     first_name?: ?string,
 *     middle_name?: ?string,
 *     last_name?: ?string,
 *     suffix?: ?string,
 *     gender?: ?string,
 *     dob?: ?string,
 *     company?: ?string,
 *     company_name?: ?string,
 *     employer?: ?string,
 *     point_of_contact?: ?string,
 *     associated_companies?: ?CompanyResponseSchema[],
 *     title?: ?string,
 *     twitter_url?: ?string,
 *     linkedin_url?: ?string,
 *     facebook_url?: ?string,
 *     website_url?: ?string,
 *     emails?: ?ContactMetaResponseSchema[],
 *     phones?: ?ContactMetaResponseSchema[],
 *     primary_email?: ?string,
 *     primary_phone?: ?string,
 *     note?: ?string,
 *     addresses?: ?AddressResponseSchema[],
 *     primary_address?: ?AddressResponseSchema,
 *     stats?: ?StatsResponseSchema,
 *     tags?: ?string[],
 *     custom_fields?: ?CustomFieldResponseSchema[],
 *     external_ids?: ?int[],
 *     is_email_subscribed?: ?bool,
 *     is_phone_subscribed?: ?bool,
 *     is_address_subscribed?: ?bool,
 *     address_unsubscribed_at?: ?string,
 *     archived_at?: ?string,
 *     created_at?: ?string,
 *     updated_at?: ?string,
 *     preferred_name?: ?string,
 *     salutation_name?: ?string,
 *     message?: ?string,
 *     errors?: ?array<string, string[]>
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

    use HasErrors;

    /**
     * @param  null|CompanyResponse[]  $associatedCompanies
     * @param  null|ContactMetaResponse[]  $emails
     * @param  null|ContactMetaResponse[]  $phones
     * @param  null|AddressResponse[]  $addresses
     * @param  null|string[]  $tags
     * @param  null|CustomFieldResponse[]  $customFields
     * @param  null|int[]  $externalIds
     * @param  null|array<string, string[]>  $errors
     */
    public function __construct(
        public ?int $id,
        public ?string $type,
        public ?string $prefix,
        public ?string $firstName,
        public ?string $middleName,
        public ?string $lastName,
        public ?string $suffix,
        public ?string $gender,
        public ?CarbonImmutable $dob,
        public ?string $company,
        public ?string $companyName,
        public ?string $employer,
        public ?string $pointOfContact,
        public ?array $associatedCompanies,
        public ?string $title,
        public ?string $twitterUrl,
        public ?string $linkedInUrl,
        public ?string $facebookUrl,
        public ?string $websiteUrl,
        public ?array $emails,
        public ?array $phones,
        public ?string $primaryEmail,
        public ?string $primaryPhone,
        public ?string $note,
        public ?array $addresses,
        public ?AddressResponse $primaryAddress,
        public ?StatsResponse $stats,
        public ?array $tags,
        public ?array $customFields,
        public ?array $externalIds,
        public ?bool $isEmailSubscribed,
        public ?bool $isPhoneSubscribed,
        public ?bool $isAddressSubscribed,
        public ?CarbonImmutable $addressUnsubscribedAt,
        public ?CarbonImmutable $archivedAt,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $updatedAt,
        public ?string $preferredName,
        public ?string $salutationName,
        public ?string $message,
        public ?array $errors,
    ) {
        //
    }

    /**
     * @param  GetContactResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['type'] ?? null,
            $attributes['prefix'] ?? null,
            $attributes['first_name'] ?? null,
            $attributes['middle_name'] ?? null,
            $attributes['last_name'] ?? null,
            $attributes['suffix'] ?? null,
            $attributes['gender'] ?? null,
            isset($attributes['dob']) ? CarbonImmutable::parse($attributes['dob']) : null,
            $attributes['company'] ?? null,
            $attributes['company_name'] ?? null,
            $attributes['employer'] ?? null,
            $attributes['point_of_contact'] ?? null,
            isset($attributes['associated_companies'])
                ? array_map(static fn (array $company): CompanyResponse => CompanyResponse::from($company), $attributes['associated_companies'])
                : null,
            $attributes['title'] ?? null,
            $attributes['twitter_url'] ?? null,
            $attributes['linkedin_url'] ?? null,
            $attributes['facebook_url'] ?? null,
            $attributes['website_url'] ?? null,
            isset($attributes['emails'])
                ? array_map(static fn (array $email): ContactMetaResponse => ContactMetaResponse::from($email), $attributes['emails'])
                : null,
            isset($attributes['phones'])
                ? array_map(static fn (array $phone): ContactMetaResponse => ContactMetaResponse::from($phone), $attributes['phones'])
                : null,
            $attributes['primary_email'] ?? null,
            $attributes['primary_phone'] ?? null,
            $attributes['note'] ?? null,
            isset($attributes['addresses'])
                ? array_map(static fn (array $address): AddressResponse => AddressResponse::from($address), $attributes['addresses'])
                : null,
            isset($attributes['primary_address']) ? AddressResponse::from($attributes['primary_address']) : null,
            isset($attributes['stats']) ? StatsResponse::from($attributes['stats']) : null,
            $attributes['tags'] ?? null,
            isset($attributes['custom_fields'])
                ? array_map(static fn (array $field): CustomFieldResponse => CustomFieldResponse::from($field), $attributes['custom_fields'])
                : null,
            $attributes['external_ids'] ?? null,
            $attributes['is_email_subscribed'] ?? null,
            $attributes['is_phone_subscribed'] ?? null,
            $attributes['is_address_subscribed'] ?? null,
            isset($attributes['address_unsubscribed_at']) ? CarbonImmutable::parse($attributes['address_unsubscribed_at']) : null,
            isset($attributes['archived_at']) ? CarbonImmutable::parse($attributes['archived_at']) : null,
            isset($attributes['created_at']) ? CarbonImmutable::parse($attributes['created_at']) : null,
            isset($attributes['updated_at']) ? CarbonImmutable::parse($attributes['updated_at']) : null,
            $attributes['preferred_name'] ?? null,
            $attributes['salutation_name'] ?? null,
            $attributes['message'] ?? null,
            $attributes['errors'] ?? null,
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
            'associated_companies' => $this->associatedCompanies !== null
                ? array_map(static fn (CompanyResponse $company): array => $company->toArray(), $this->associatedCompanies) // @pest-mutate-ignore
                : null,
            'title' => $this->title,
            'twitter_url' => $this->twitterUrl,
            'linkedin_url' => $this->linkedInUrl,
            'facebook_url' => $this->facebookUrl,
            'website_url' => $this->websiteUrl,
            'emails' => $this->emails !== null
                ? array_map(static fn (ContactMetaResponse $email): array => $email->toArray(), $this->emails) // @pest-mutate-ignore
                : null,
            'phones' => $this->phones !== null
                ? array_map(static fn (ContactMetaResponse $address): array => $address->toArray(), $this->phones) // @pest-mutate-ignore
                : null,
            'primary_email' => $this->primaryEmail,
            'primary_phone' => $this->primaryPhone,
            'note' => $this->note,
            'addresses' => $this->addresses !== null
                ? array_map(static fn (AddressResponse $address): array => $address->toArray(), $this->addresses) // @pest-mutate-ignore
                : null,
            'primary_address' => $this->primaryAddress?->toArray(),
            'stats' => $this->stats?->toArray(),
            'tags' => $this->tags,
            'custom_fields' => $this->customFields !== null
                ? array_map(static fn (CustomFieldResponse $field): array => $field->toArray(), $this->customFields) // @pest-mutate-ignore
                : null,
            'external_ids' => $this->externalIds,
            'is_email_subscribed' => $this->isEmailSubscribed,
            'is_phone_subscribed' => $this->isPhoneSubscribed,
            'is_address_subscribed' => $this->isAddressSubscribed,
            'address_unsubscribed_at' => $this->addressUnsubscribedAt?->toIso8601String(),
            'archived_at' => $this->archivedAt?->toIso8601String(),
            'created_at' => $this->createdAt?->toIso8601String(),
            'updated_at' => $this->updatedAt?->toIso8601String(),
            'preferred_name' => $this->preferredName,
            'salutation_name' => $this->salutationName,
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
