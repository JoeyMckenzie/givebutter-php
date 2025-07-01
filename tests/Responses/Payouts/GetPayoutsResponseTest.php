<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Payouts\GetPayoutsResponse;
use Givebutter\Testing\Fixtures\Payouts\GetPayoutsFixture;

covers(GetPayoutsResponse::class);

describe(GetPayoutsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetPayoutsFixture::data();
        $this->response = GetPayoutsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetPayoutsResponse::class)
            ->data->toBeArray()->each->toBePayout()
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
        $fake = GetPayoutsResponse::fake(GetPayoutsFixture::class);

        // Assert
        expect($fake)->toBeInstanceOf(GetPayoutsResponse::class)
            ->data->toBeArray()->each->toBePayout()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
