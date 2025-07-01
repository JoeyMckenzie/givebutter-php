<?php

declare(strict_types=1);

namespace Tests\Responses;

use Givebutter\Responses\Contacts\GetContactsResponse;
use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Givebutter\Testing\Fixtures\Contacts\GetContactsFixture;

covers(GetContactsResponse::class);

describe(GetContactsResponse::class, function (): void {
    beforeEach(function (): void {
        $this->data = GetContactsFixture::data();
        $this->response = GetContactsResponse::from($this->data);
    });

    it('returns a valid typed object', function (): void {
        // Arrange & Act & Assert
        expect($this->response)->toBeInstanceOf(GetContactsResponse::class)
            ->data->toBeArray()->each->toBeContact()
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
        $fake = GetContactsResponse::fake(GetContactsFixture::class);

        // Assert

        expect($fake)->toBeInstanceOf(GetContactsResponse::class)
            ->data->toBeArray()->each->toBeContact()
            ->meta->toBeInstanceOf(MetaResponse::class)
            ->links->toBeInstanceOf(LinksResponse::class);
    });
});
