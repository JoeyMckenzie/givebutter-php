<?php

declare(strict_types=1);

use Givebutter\Resources\PlansResource;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Responses\Plans\GetPlansResponse;
use Givebutter\Testing\Fixtures\Plans\GetPlanFixture;
use Givebutter\Testing\Fixtures\Plans\GetPlansFixture;
use Tests\Mocks\ClientMock;
use Wrapkit\ValueObjects\Response;

covers(PlansResource::class);

describe(PlansResource::class, function (): void {
    it('can retrieve a single plan', function (): void {
        // Arrange
        $client = ClientMock::get(
            'plans/abc123',
            Response::from(GetPlanFixture::data()),
        );

        // Act
        $result = $client->plans()->get('abc123');

        // Assert
        expect($result)->toBePlan();
    });

    it('can retrieve all plans', function (): void {
        // Arrange
        $client = ClientMock::get(
            'plans',
            Response::from(GetPlansFixture::data()),
        );

        // Act
        $result = $client->plans()->list();

        // Assert
        expect($result)->toBeInstanceOf(GetPlansResponse::class)
            ->data->each->toBePlan()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
