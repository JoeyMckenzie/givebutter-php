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
            ->and($data['created_at'])->toBeString()
            ->and($data['updated_at'])->toBeString()
            ->and($data['message'])->toBeNull()
            ->and($data['errors'])->toBeNull();
    });

    it('is accessible from an array with errors', function (): void {
        // Arrange
        $this->response = GetFundResponse::from(GetFundFixture::errors());

        // Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['id'])->toBeNull()
            ->and($data['code'])->toBeNull()
            ->and($data['name'])->toBeNull()
            ->and($data['raised'])->toBeNull()
            ->and($data['supporters'])->toBeNull()
            ->and($data['created_at'])->toBeNull()
            ->and($data['updated_at'])->toBeNull()
            ->and($data['message'])->toBeString()
            ->and($data['errors'])->toBeArray();
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
        expect($response)->toBeFallibleFund()
            ->message->toBeString()
            ->errors->toBeArray();
    });
});
