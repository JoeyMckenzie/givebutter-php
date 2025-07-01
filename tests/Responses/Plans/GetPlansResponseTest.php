<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Givebutter\Responses\Plans\GetPlansResponse;
use Givebutter\Testing\Fixtures\Plans\GetPlansFixture;

covers(GetPlansResponse::class);

describe(GetPlansResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetPlansFixture::data();
        $this->response = GetPlansResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetPlansResponse::class)
            ->data->toBeArray()->each->toBePlan()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
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
        $fake = GetPlansResponse::fake(GetPlansFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetPlansResponse::class)
            ->data->toBeArray()->each->toBePlan()
            ->meta->toBeInstanceOf(Meta::class)
            ->links->toBeInstanceOf(Links::class);
    });
});
