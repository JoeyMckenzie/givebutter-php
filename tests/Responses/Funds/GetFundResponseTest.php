<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Testing\Fixtures\Funds\GetFundFixture;

covers(GetFundResponse::class);

describe(GetFundResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetFundFixture::data();
        $this->response = GetFundResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeFund();
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeString()
            ->and($data['code'])->toBeString()
            ->and($data['name'])->toBeString()
            ->and($data['raised'])->toBeInt()
            ->and($data['supporters'])->toBeInt()
            ->and($data['created_at'])->toBeString()->not->toBeEmpty()
            ->and($data['updated_at'])->toBeString()->not->toBeEmpty()
            ->and($data['message'])->toBeNull()
            ->and($data['errors'])->toBeNull();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetFundResponse::fake(GetFundFixture::class);

        // Assert

        expect($fake)->toBeFund();
    });

    it('can override properties on fakes', function (): void {
        // Arrange & Act
        $fake = GetFundResponse::fake(GetFundFixture::class, [
            'supporters' => 42,
        ]);

        // Assert
        expect($fake)->toBeFund()
            ->supporters->toBe(42);
    });

    it('can contain errors', function (): void {
        // Arrange & Act
        $response = GetFundResponse::from(GetFundFixture::errors());

        // Assert
        expect($response)->toBeFundWithErrors();
    });

    it('handles null dates', function (): void {
        // Arrange
        $data = GetFundFixture::data();
        $data['created_at'] = null;
        $data['updated_at'] = null;

        // Act
        $response = GetFundResponse::from($data);
        $arrayData = $response->toArray();

        // Assert
        expect($response)->toBeInstanceOf(GetFundResponse::class)
            ->createdAt->toBeNull()
            ->and($arrayData['created_at'])->toBeNull()
            ->updatedAt->toBeNull()
            ->and($arrayData['updated_at'])->toBeNull();
    });
});
