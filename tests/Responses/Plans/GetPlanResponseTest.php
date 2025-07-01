<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Plans\GetPlanResponse;
use Givebutter\Testing\Fixtures\Plans\GetPlanFixture;

covers(GetPlanResponse::class);

describe(GetPlanResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetPlanFixture::data();
        $this->response = GetPlanResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBePlan()
            ->and($this->response->hasErrorMessage())->toBeFalse();
    });

    it('can contain errors', function (): void {
        // Arrange
        $errors = GetPlanFixture::errors();

        // Act
        $response = GetPlanResponse::from($errors);

        expect($response)->toBePlanWithErrors()
            ->and($response->hasErrorMessage())->toBeTrue();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeString()
            ->and($data['first_name'])->toBeString()
            ->and($data['last_name'])->toBeString()
            ->and($data['email'])->toBeString()
            ->and($data['phone'])->toBeString()
            ->and($data['frequency'])->toBeString()
            ->and($data['status'])->toBeString()
            ->and($data['method'])->toBeString()
            ->and($data['amount'])->toBeInt()
            ->and($data['fee_covered'])->toBeInt()
            ->and($data['created_at'])->toBeString()
            ->and($data['started_at'])->toBeString()
            ->and($data['next_start_date'])->toBeString()
            ->and($data['message'])->toBeNull();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetPlanResponse::fake(GetPlanFixture::class);

        // Assert

        expect($fake)->toBePlan();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetPlanResponse::fake(GetPlanFixture::class, [
            'amount' => 42,
        ]);

        // Assert
        expect($fake)->toBePlan()
            ->amount->toBe(42);
    });

    it('handles null coalesced fields correctly', function (): void {
        // Arrange
        $data = GetPlanFixture::data();
        $data['created_at'] = null;
        $data['started_at'] = null;
        $data['next_start_date'] = null;

        // Act
        $response = GetPlanResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response)->toBeInstanceOf(GetPlanResponse::class)
            ->createdAt->toBeNull()
            ->startedAt->toBeNull()
            ->nextStartDate->toBeNull();

        expect($arrayData)->toBeArray()
            ->and($arrayData['created_at'])->toBeNull()
            ->and($arrayData['started_at'])->toBeNull()
            ->and($arrayData['next_start_date'])->toBeNull();
    });
});
