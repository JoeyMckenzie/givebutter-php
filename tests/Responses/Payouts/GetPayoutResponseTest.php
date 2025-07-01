<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Testing\Fixtures\Payouts\GetPayoutFixture;

covers(GetPayoutResponse::class);

describe(GetPayoutResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetPayoutFixture::data();
        $this->response = GetPayoutResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBePayout()
            ->and($this->response->hasErrorMessage())->toBeFalse();
    });

    it('can contain errors', function (): void {
        // Arrange
        $errors = GetPayoutFixture::errors();

        // Act
        $response = GetPayoutResponse::from($errors);

        // Assert
        expect($response)->toBePayoutWithErrors()
            ->and($response->hasErrorMessage())->toBeTrue();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeString()
            ->and($data['campaign_id'])->toBeInt()
            ->and($data['method'])->toBeString()
            ->and($data['status'])->toBeString()
            ->and($data['amount'])->toBeInt()
            ->and($data['fee'])->toBeInt()
            ->and($data['tip'])->toBeInt()
            ->and($data['payout'])->toBeInt()
            ->and($data['currency'])->toBeString()
            ->and($data['address'])->toBeArray()
            ->and($data['memo'])->toBeString()
            ->and($data['completed_at'])->toBeString()
            ->and($data['created_at'])->toBeString()
            ->and($data['message'])->toBeNull();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetPayoutResponse::fake(GetPayoutFixture::class);

        // Assert
        expect($fake)->toBePayout();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetPayoutResponse::fake(GetPayoutFixture::class, [
            'method' => 'bank',
            'status' => 'completed',
        ]);

        // Assert
        expect($fake)->toBePayout()
            ->method->toBe('bank')
            ->status->toBe('completed');
    });

    it('handles nullable fields correctly', function (): void {
        // Arrange
        $data = GetPayoutFixture::data();
        $data['address'] = null;
        $data['memo'] = null;
        $data['completed_at'] = null;
        $data['created_at'] = null;

        // Act
        $response = GetPayoutResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response->address)->toBeNull()
            ->and($arrayData['address'])->toBeNull()
            ->and($response->memo)->toBeNull()
            ->and($arrayData['memo'])->toBeNull()
            ->and($response->completedAt)->toBeNull()
            ->and($arrayData['completed_at'])->toBeNull()
            ->and($response->createdAt)->toBeNull()
            ->and($arrayData['created_at'])->toBeNull();
    });
});
