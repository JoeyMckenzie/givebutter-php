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
        expect($this->response)->toBeInstanceOf(GetPayoutResponse::class)
            ->id->toBeString()
            ->campaignId->toBeInt()
            ->method->toBeString()
            ->status->toBeString()
            ->amount->toBeInt()
            ->fee->toBeInt()
            ->tip->toBeInt()
            ->payout->toBeInt()
            ->currency->toBeString()
            ->createdAt->toBeInstanceOf(\Carbon\CarbonImmutable::class);
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
            ->and($data['address'])->toBeNullOrArray()
            ->and($data['memo'])->toBeNullOrString()
            ->and($data['completed_at'])->toBeNullOrString()
            ->and($data['created_at'])->toBeString();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetPayoutResponse::fake(GetPayoutFixture::class);

        // Assert
        expect($fake)->toBeInstanceOf(GetPayoutResponse::class)
            ->id->toBeString()
            ->campaignId->toBeInt()
            ->method->toBeString()
            ->status->toBeString()
            ->amount->toBeInt()
            ->fee->toBeInt()
            ->tip->toBeInt()
            ->payout->toBeInt()
            ->currency->toBeString()
            ->createdAt->toBeInstanceOf(\Carbon\CarbonImmutable::class);
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetPayoutResponse::fake(GetPayoutFixture::class, [
            'method' => 'bank',
            'status' => 'completed',
        ]);

        // Assert
        expect($fake)->toBeInstanceOf(GetPayoutResponse::class)
            ->method->toBe('bank')
            ->status->toBe('completed');
    });

    it('handles nullable fields correctly', function (): void {
        // Arrange
        $data = GetPayoutFixture::data();
        $data['address'] = null;
        $data['memo'] = null;
        $data['completed_at'] = null;

        // Act
        $response = GetPayoutResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response->address)->toBeNull()
            ->and($arrayData['address'])->toBeNull()
            ->and($response->memo)->toBeNull()
            ->and($arrayData['memo'])->toBeNull()
            ->and($response->completedAt)->toBeNull()
            ->and($arrayData['completed_at'])->toBeNull();
    });
});
