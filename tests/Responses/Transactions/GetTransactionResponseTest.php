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
        expect($this->response)->toBeTransaction()
            ->and($this->response->hasErrors())->toBeFalse()
            ->and($this->response->hasErrorMessage())->toBeFalse();
    });

    it('can contain errors', function (): void {
        // Arrange
        $errors = GetTransactionFixture::errors();

        // Act
        $response = GetTransactionResponse::from($errors);

        expect($response)->toBeTransactionWithErrors()
            ->and($response->hasErrors())->toBeTrue()
            ->and($response->hasErrorMessage())->toBeTrue();
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
            ->and($data['plan_id'])->toBeString()
            ->and($data['pledge_id'])->toBeString()
            ->and($data['team_id'])->toBeString()
            ->and($data['member_id'])->toBeString()
            ->and($data['fund_id'])->toBeString()
            ->and($data['fund_code'])->toBeString()
            ->and($data['contact_id'])->toBeInt()
            ->and($data['first_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['company_name'])->toBeString()
            ->and($data['company'])->toBeString()
            ->and($data['email'])->toBeString()
            ->and($data['phone'])->toBeString()
            ->and($data['address'])->toBeArray()
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
            ->and($data['giving_space'])->toBeArray()
            ->and($data['dedication'])->toBeArray()
            ->and($data['transactions'])->toBeArray()
            ->and($data['custom_fields'])->toBeArray()
            ->and($data['utm_parameters'])->toBeArray()
            ->and($data['external_id'])->toBeString()
            ->and($data['communication_opt_in'])->toBeBool()
            ->and($data['session_id'])->toBeString()
            ->and($data['attribution_data'])->toBeArray()
            ->and($data['fair_market_value_amount'])->toBeInt()
            ->and($data['tax_deductible_amount'])->toBeInt()
            ->and($data['message'])->toBeNull()
            ->and($data['errors'])->toBeNull();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetTransactionResponse::fake(GetTransactionFixture::class);

        // Assert

        expect($fake)->toBeTransaction();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetTransactionResponse::fake(GetTransactionFixture::class, [
            'email' => 'michael.scarn@dundermifflin.com',
        ]);

        // Assert
        expect($fake)->toBeTransaction()
            ->email->toBe('michael.scarn@dundermifflin.com');
    });

    it('handles nullable fields correctly', function (): void {
        // Arrange
        $data = GetTransactionFixture::data();
        $data['giving_space'] = null;
        $data['dedication'] = null;
        $data['address'] = null;
        $data['transacted_at'] = null;
        $data['created_at'] = null;

        // Act
        $response = GetTransactionResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response->givingSpace)->toBeNull()
            ->and($arrayData['giving_space'])->toBeNull()
            ->and($response->dedication)->toBeNull()
            ->and($arrayData['dedication'])->toBeNull()
            ->and($response->address)->toBeNull()
            ->and($arrayData['address'])->toBeNull()
            ->and($response->transactedAt)->toBeNull()
            ->and($arrayData['transacted_at'])->toBeNull()
            ->and($response->createdAt)->toBeNull()
            ->and($arrayData['created_at'])->toBeNull();
    });
});
