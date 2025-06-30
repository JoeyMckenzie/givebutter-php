<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Transactions\GetTransactionResponse;
use Givebutter\Testing\Fixtures\Transactions\GetTransactionFixture;

covers(GetTransactionResponse::class);

describe(GetTransactionResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetTransactionFixture::data();
        $this->response = GetTransactionResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeTransactionResponse();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeString()
            ->and($data['number'])->toBeString()
            ->and($data['campaign_id'])->toBeInt()
            ->and($data['campaign_code'])->toBeString()
            ->and($data['plan_id'])->toBeNullOrString()
            ->and($data['pledge_id'])->toBeNullOrString()
            ->and($data['team_id'])->toBeNullOrString()
            ->and($data['member_id'])->toBeNullOrString()
            ->and($data['fund_id'])->toBeNullOrString()
            ->and($data['fund_code'])->toBeNullOrString()
            ->and($data['contact_id'])->toBeInt()
            ->and($data['first_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['company_name'])->toBeNullOrString()
            ->and($data['company'])->toBeNullOrString()
            ->and($data['email'])->toBeString()
            ->and($data['phone'])->toBeString()
            ->and($data['address'])->toBeNullOrArray()
            ->and($data['status'])->toBeString()
            ->and($data['payment_method'])->toBeString()
            ->and($data['method'])->toBeString()
            ->and($data['amount'])->toBeInt()
            ->and($data['fee'])->toBeInt()
            ->and($data['fee_covered'])->toBeInt()
            ->and($data['donated'])->toBeInt()
            ->and($data['payout'])->toBeInt()
            ->and($data['currency'])->toBeString()
            ->and($data['transacted_at'])->toBeString()
            ->and($data['created_at'])->toBeString()
            ->and($data['timezone'])->toBeString()
            ->and($data['giving_space'])->toBeNullOrArray()
            ->and($data['dedication'])->toBeNullOrArray()
            ->and($data['transactions'])->toBeNullOrArray()
            ->and($data['custom_fields'])->toBeArray()
            ->and($data['utm_parameters'])->toBeArray()
            ->and($data['external_id'])->toBeNullOrString()
            ->and($data['communication_opt_in'])->toBeBool()
            ->and($data['session_id'])->toBeString()
            ->and($data['attribution_data'])->toBeArray()
            ->and($data['fair_market_value_amount'])->toBeNullOrInt()
            ->and($data['tax_deductible_amount'])->toBeNullOrInt();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetTransactionResponse::fake(GetTransactionFixture::class);

        // Assert

        expect($fake)->toBeTransactionResponse();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetTransactionResponse::fake(GetTransactionFixture::class, [
            'email' => 'michael.scarn@dundermifflin.com',
        ]);

        // Assert
        expect($fake)->toBeTransactionResponse()
            ->email->toBe('michael.scarn@dundermifflin.com');
    });
});
