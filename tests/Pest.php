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
use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Responses\Models\AddressResponse;
use Givebutter\Responses\Models\CompanyResponse;
use Givebutter\Responses\Models\ContactMetaResponse;
use Givebutter\Responses\Models\CoverResponse;
use Givebutter\Responses\Models\CustomFieldResponse;
use Givebutter\Responses\Models\DedicationResponse;
use Givebutter\Responses\Models\EventResponse;
use Givebutter\Responses\Models\GivingSpaceResponse;
use Givebutter\Responses\Models\StatsResponse;
use Givebutter\Responses\Models\TransactionResponse;
use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Responses\Plans\GetPlanResponse;
use Givebutter\Responses\Tickets\GetTicketResponse;
use Givebutter\Responses\Transactions\GetTransactionResponse;

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
expect()->extend('toBeNullOrInt', fn () => $this->value === null ? $this : $this->toBeInt());
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
    ->cover->toBeInstanceOf(CoverResponse::class)
    ->event->toBeInstanceOf(EventResponse::class));

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
    ->url->toBeString()
    ->message->toBeNull()
    ->errors->toBeNull());

expect()->extend('toBeFallibleCampaignMember', fn () => $this->toBeInstanceOf(GetCampaignMemberResponse::class)
    ->id->toBeNull()
    ->firstName->toBeNull()
    ->lastName->toBeNull()
    ->email->toBeNull()
    ->phone->toBeNull()
    ->displayName->toBeNull()
    ->picture->toBeNull()
    ->raised->toBeNull()
    ->goal->toBeNull()
    ->donors->toBeNull()
    ->items->toBeNull()
    ->url->toBeNull()
    ->message->toBeString()
    ->errors->toBeArray());

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
    ->associatedCompanies->toBeArray()->each->toBeInstanceOf(CompanyResponse::class)
    ->title->toBeNullOrString()
    ->twitterUrl->toBeNullOrString()
    ->linkedInUrl->toBeNullOrString()
    ->facebookUrl->toBeNullOrString()
    ->websiteUrl->toBeNullOrString()
    ->emails->toBeArray()->each->toBeInstanceOf(ContactMetaResponse::class)
    ->phones->toBeArray()->each->toBeInstanceOf(ContactMetaResponse::class)
    ->primaryEmail->toBeNullOrString()
    ->primaryPhone->toBeNullOrString()
    ->note->toBeNullOrString()
    ->addresses->toBeArray()->each->toBeInstanceOf(AddressResponse::class)
    ->primaryAddress->toBeNullOrInstanceOf(AddressResponse::class)
    ->stats->toBeInstanceOf(StatsResponse::class)
    ->tags->toBeArray()->each->toBeString()
    ->customFields->toBeArray()->each->toBeInstanceOf(CustomFieldResponse::class)
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

expect()->extend('toBeTransactionResponse', fn () => $this->toBeInstanceOf(GetTransactionResponse::class)
    ->id->toBeString()
    ->number->toBeString()
    ->campaignId->toBeInt()
    ->campaignCode->toBeString()
    ->planId->toBeNullOrString()
    ->pledgeId->toBeNullOrString()
    ->teamId->toBeNullOrString()
    ->memberId->toBeNullOrString()
    ->fundId->toBeNullOrString()
    ->fundCode->toBeNullOrString()
    ->contactId->toBeInt()
    ->firstName->toBeString()
    ->lastName->toBeString()
    ->companyName->toBeNullOrString()
    ->company->toBeNullOrString()
    ->email->toBeNullOrString()
    ->phone->toBeNullOrString()
    ->address->toBeNullOrInstanceOf(AddressResponse::class)
    ->status->toBeString()
    ->paymentMethod->toBeString()
    ->method->toBeString()
    ->amount->toBeInt()
    ->fee->toBeInt()
    ->feeCovered->toBeInt()
    ->donated->toBeInt()
    ->payout->toBeInt()
    ->currency->toBeString()
    ->transactedAt->toBeInstanceOf(CarbonImmutable::class)
    ->createdAt->toBeInstanceOf(CarbonImmutable::class)
    ->timezone->toBeString()
    ->givingSpace->toBeNullOrInstanceOf(GivingSpaceResponse::class)
    ->dedication->toBeNullOrInstanceOf(DedicationResponse::class)
    ->transactions->toBeArray()->each->toBeInstanceOf(TransactionResponse::class)
    ->customFields->toBeArray()->each->toBeInstanceOf(CustomFieldResponse::class)
    ->utmParameters->toBeArray()
    ->externalId->toBeNullOrString()
    ->communicationOptIn->toBeBool()
    ->sessionId->toBeNullOrString()
    ->attributionData->toBeNullOrArray()
    ->fairMarketValueAmount->toBeNullOrInt()
    ->taxDeductibleAmount->toBeNullOrInt());

expect()->extend('toBePayout', fn () => $this->toBeInstanceOf(GetPayoutResponse::class)
    ->id->toBeString()
    ->campaignId->toBeInt()
    ->method->toBeString()
    ->status->toBeString()
    ->amount->toBeInt()
    ->fee->toBeInt()
    ->tip->toBeInt()
    ->payout->toBeInt()
    ->currency->toBeString()
    ->address->toBeNullOrInstanceOf(AddressResponse::class)
    ->memo->toBeNullOrString()
    ->completedAt->toBeNullOrInstanceOf(CarbonImmutable::class)
    ->createdAt->toBeInstanceOf(CarbonImmutable::class));

expect()->extend('toBePlan', fn () => $this->toBeInstanceOf(GetPlanResponse::class)
    ->id->toBeString()
    ->firstName->toBeString()
    ->lastName->toBeString()
    ->email->toBeString()
    ->phone->toBeString()
    ->frequency->toBeString()
    ->status->toBeString()
    ->method->toBeString()
    ->amount->toBeInt()
    ->feeCovered->toBeInt()
    ->createdAt->toBeInstanceOf(CarbonImmutable::class)
    ->startedAt->toBeInstanceOf(CarbonImmutable::class)
    ->nextStartDate->toBeInstanceOf(CarbonImmutable::class));

expect()->extend('toBeFund', fn () => $this->toBeInstanceOf(GetFundResponse::class)
    ->id->toBeString()
    ->code->toBeString()
    ->name->toBeString()
    ->raised->toBeInt()
    ->supporters->toBeInt()
    ->createdAt->toBeInstanceOf(CarbonImmutable::class)
    ->updatedAt->toBeInstanceOf(CarbonImmutable::class)
    ->message->toBeNull()
    ->errors->toBeNull());

expect()->extend('toBeFallibleFund', fn () => $this->toBeInstanceOf(GetFundResponse::class)
    ->id->toBeNull()
    ->code->toBeNull()
    ->name->toBeNull()
    ->raised->toBeNull()
    ->supporters->toBeNull()
    ->createdAt->toBeNull()
    ->updatedAt->toBeNull()
    ->message->toBeString()
    ->errors->toBeArray());

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
