<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use Carbon\CarbonImmutable;
use Givebutter\Responses\Campaigns\GetCampaignMemberResponse;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Responses\Campaigns\GetCampaignTeamResponse;
use Givebutter\Responses\Contacts\GetContactResponse;
use Givebutter\Responses\Models\Address;
use Givebutter\Responses\Models\Company;
use Givebutter\Responses\Models\ContactMeta;
use Givebutter\Responses\Models\Cover;
use Givebutter\Responses\Models\CustomField;
use Givebutter\Responses\Models\Event;
use Givebutter\Responses\Models\Stats;
use Givebutter\Responses\Tickets\GetTicketResponse;

pest()->extend(Tests\TestCase::class)
    ->in(__DIR__);

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeNullOrInstanceOf', fn (string $value) => $this->value === null ? $this : $this->toBeInstanceOf($value));
expect()->extend('toBeNullOrString', fn () => $this->value === null ? $this : $this->toBeString());
expect()->extend('toBeNullOrArray', fn () => $this->value === null ? $this : $this->toBeArray());

expect()->extend('toBeCampaign', fn () => $this->toBeInstanceOf(GetCampaignResponse::class)
    ->id->toBeInt()
    ->code->toBeString()
    ->accountId->toBeString()
    ->eventId->toBeInt()
    ->type->toBeString()
    ->title->toBeString()
    ->subtitle->toBeString()
    ->description->toBeString()
    ->slug->toBeString()
    ->url->toBeString()
    ->goal->toBeInt()
    ->raised->toBeInt()
    ->donors->toBeInt()
    ->currency->toBeString()
    ->status->toBeString()
    ->timezone->toBeString()
    ->endAt->toBeInstanceOf(CarbonImmutable::class)
    ->createdAt->toBeInstanceOf(CarbonImmutable::class)
    ->updatedAt->toBeInstanceOf(CarbonImmutable::class)
    ->cover->toBeInstanceOf(Cover::class)
    ->event->toBeInstanceOf(Event::class));

expect()->extend('toBeCampaignMember', fn () => $this->toBeInstanceOf(GetCampaignMemberResponse::class)
    ->id->toBeInt()
    ->firstName->toBeString()
    ->lastName->toBeString()
    ->email->toBeString()
    ->phone->toBeString()
    ->displayName->toBeString()
    ->picture->toBeString()
    ->raised->toBeInt()
    ->goal->toBeInt()
    ->donors->toBeInt()
    ->items->toBeInt()
    ->url->toBeString());

expect()->extend('toBeCampaignTeam', fn () => $this->toBeInstanceOf(GetCampaignTeamResponse::class)
    ->id->toBeInt()
    ->name->toBeString()
    ->logo->toBeString()
    ->slug->toBeString()
    ->url->toBeString()
    ->raised->toBeInt()
    ->goal->toBeInt()
    ->supporters->toBeInt()
    ->members->toBeInt());

expect()->extend('toBeContact', fn () => $this->toBeInstanceOf(GetContactResponse::class)
    ->id->toBeInt()
    ->type->toBeString()
    ->prefix->toBeNullOrString()
    ->firstName->toBeString()
    ->middleName->toBeNullOrString()
    ->lastName->toBeString()
    ->suffix->toBeNullOrString()
    ->gender->toBeNullOrString()
    ->dob->toBeNullOrInstanceOf(CarbonImmutable::class)
    ->company->toBeNullOrString()
    ->companyName->toBeNullOrString()
    ->employer->toBeNullOrString()
    ->pointOfContact->toBeNullOrString()
    ->associatedCompanies->toBeArray()->each->toBeInstanceOf(Company::class)
    ->title->toBeNullOrString()
    ->twitterUrl->toBeNullOrString()
    ->linkedInUrl->toBeNullOrString()
    ->facebookUrl->toBeNullOrString()
    ->websiteUrl->toBeNullOrString()
    ->emails->toBeArray()->each->toBeInstanceOf(ContactMeta::class)
    ->phones->toBeArray()->each->toBeInstanceOf(ContactMeta::class)
    ->primaryEmail->toBeNullOrString()
    ->primaryPhone->toBeNullOrString()
    ->note->toBeNullOrString()
    ->addresses->toBeArray()->each->toBeInstanceOf(Address::class)
    ->primaryAddress->toBeNullOrInstanceOf(Address::class)
    ->stats->toBeInstanceOf(Stats::class)
    ->tags->toBeArray()->each->toBeString()
    ->customFields->toBeArray()->each->toBeInstanceOf(CustomField::class)
    ->externalIds->toBeArray()->each->toBeInt()
    ->isEmailSubscribed->toBeBool()
    ->isPhoneSubscribed->toBeBool()
    ->isAddressSubscribed->toBeBool()
    ->addressUnsubscribedAt->toBeNullOrInstanceOf(CarbonImmutable::class)
    ->archivedAt->toBeNullOrInstanceOf(CarbonImmutable::class)
    ->createdAt->toBeInstanceOf(CarbonImmutable::class)
    ->updatedAt->toBeInstanceOf(CarbonImmutable::class)
    ->preferredName->toBeNullOrString()
    ->salutationName->toBeString());

expect()->extend('toBeTicket', fn () => $this->toBeInstanceOf(GetTicketResponse::class)
    ->id->toBeString()
    ->idSuffix->toBeString()
    ->name->toBeString()
    ->firstName->toBeString()
    ->lastName->toBeString()
    ->email->toBeString()
    ->phone->toBeString()
    ->title->toBeString()
    ->description->toBeString()
    ->price->toBeInt()
    ->pdf->toBeString()
    ->arrivedAt->toBeInstanceOf(CarbonImmutable::class)
    ->createdAt->toBeInstanceOf(CarbonImmutable::class));

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something(): void
{
    // ..
}
