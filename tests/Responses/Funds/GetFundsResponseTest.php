<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Funds\GetFundsResponse;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Testing\Fixtures\Funds\GetFundsFixture;

covers(GetFundsResponse::class);

describe(GetFundsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetFundsFixture::data();
        $this->response = GetFundsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetFundsResponse::class)
            ->data->toBeArray()->each->toBeFund()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });

    it('is accessible from an array', function (): void {
        // Arrange & Act
        $data = $this->response->toArray();

        // Assert
        expect($data)->toBeArray()
            ->and($data['data'])->toBeArray()
            ->and($data['meta'])->toBeArray()
            ->and($data['links'])->toBeArray();
    });

    it('generates fake responses', function (): void {
        // Arrange & Act
        $fake = GetFundsResponse::fake(GetFundsFixture::class);

        // Assert
        expect($fake)->toBeInstanceOf(GetFundsResponse::class)
            ->data->toBeArray()->each->toBeFund()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
