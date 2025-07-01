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
        expect($this->response)->toBePlan();
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
            ->and($data['next_start_date'])->toBeString();
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
});
