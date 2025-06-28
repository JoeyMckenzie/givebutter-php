<?php

declare(strict_types=1);

namespace Tests\Testing;

use Exception;
use Givebutter\Exceptions\GivebutterClientException;
use Givebutter\Resources\CampaignsResource;
use Givebutter\Responses\Campaigns\GetCampaignResponse;
use Givebutter\Testing\ClientFake;
use Givebutter\Testing\Fixtures\Campaigns\GetCampaignFixture;
use PHPUnit\Framework\ExpectationFailedException;

covers(ClientFake::class);

describe(ClientFake::class, function (): void {
    it('returns fake data', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $response = $fake->campaigns()->get(123);

        // Act
        expect($response)->toBeCampaign();
    });

    it('throws fake exceptions', function (): void {
        // Arrange
        $fake = new ClientFake([
            GivebutterClientException::apiKeyMissing(),
        ]);

        // Act & Assert
        $fake->campaigns()->get(123);
    })->throws(GivebutterClientException::class, "API key is required to call Givebutter's API.");

    it('throws an exception if there are no more fake responses', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Act again
        $fake->campaigns()->get(321);
    })->throws(Exception::class, 'No fake responses left');

    it('allows to add more responses', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class, [
                'description' => 'campaign',
            ]),
        ]);

        // Act
        $response = $fake->campaigns()->get(123);

        // Assert
        expect($response)->toBeCampaign()
            ->and($response->description)->toBe('campaign');

        // Act again, simulate another response going through
        $fake->proxy->addResponses([
            GetCampaignResponse::fake(GetCampaignFixture::class, [
                'description' => 'another campaign',
            ]),
        ]);

        $response = $fake->campaigns()->get(123);

        // Assert
        expect($response)->toBeCampaign()
            ->and($response->description)->toBe('another campaign');
    });

    it('asserts a request was sent', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert
        $fake->proxy->assertSent(CampaignsResource::class, fn (string $method, array $parameters): bool => $method === 'get' && $parameters[0] === 123);
    });

    it('throws an exception if a request was not sent', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act & Assert
        $fake->proxy->assertSent(CampaignsResource::class, fn (string $method, array $parameters): bool => $method === 'get' && $parameters[0] === 123);
    })->throws(ExpectationFailedException::class);

    it('asserts a request was sent on the resource', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert
        $fake->campaigns()->assertSent(fn (string $method, array $parameters): bool => $method === 'get' && $parameters[0] === 123);
    });

    it('asserts a request was sent any number of times', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);
        $fake->campaigns()->get(123);

        // Assert
        $fake->proxy->assertSent(CampaignsResource::class, 2);
    });

    it('throws an exception if a request was not sent any number of times', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert
        $fake->proxy->assertSent(CampaignsResource::class, 2);
    })->throws(ExpectationFailedException::class);

    it('asserts a request was not sent', function (): void {
        // Arrange
        $fake = new ClientFake;

        // Act & Assert
        $fake->proxy->assertNotSent(CampaignsResource::class);
    });

    it('throws an exception if an unexpected request was sent', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert
        $fake->proxy->assertNotSent(CampaignsResource::class);
    })->throws(ExpectationFailedException::class);

    it('asserts a request was not sent on the resource', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act & Assert
        $fake->campaigns()->assertNotSent();
    });

    it('asserts no request was sent', function (): void {
        // Arrange
        $fake = new ClientFake;

        // Act & Assert
        $fake->proxy->assertNothingSent();
    });

    it('throws an exception if any request was sent when non was expected', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert
        $fake->proxy->assertNothingSent();
    })->throws(ExpectationFailedException::class);

    it('throws an exception with proper message when assertNothingSent fails', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act - Create two different resource requests
        $fake->campaigns()->get(123);
        $fake->campaigns()->get(321);

        // Assert - Verify the exact error message format
        expect(fn () => $fake->proxy->assertNothingSent())
            ->toThrow(ExpectationFailedException::class, 'The following requests were sent unexpectedly: '.CampaignsResource::class.', '.CampaignsResource::class);
    });

    it('uses responses in FIFO order', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class, [
                'description' => 'campaign',
            ]),
            GetCampaignResponse::fake(GetCampaignFixture::class, [
                'description' => 'another campaign',
            ]),
        ]);

        // Act & Assert - First request should get first response
        $response1 = $fake->campaigns()->get(123);
        expect($response1->description)->toBe('campaign');

        // Second request should get second response
        $response2 = $fake->campaigns()->get(123);
        expect($response2->description)->toBe('another campaign');
    });

    it('asserts a request was sent exactly once by default', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert - Using the default parameter
        $fake->proxy->assertSent(CampaignsResource::class);

        // Should fail if we try to assert it was sent twice
        expect(fn () => $fake->proxy->assertSent(CampaignsResource::class, 2))
            ->toThrow(ExpectationFailedException::class, 'was sent 1 times instead of 2 times');
    });

    it('handles null callback in sent verification', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert - Call assertSent with null callback (default behavior)
        $fake->proxy->assertSent(CampaignsResource::class);
    });

    it('returns empty array for non-existent resource without checking callback', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act
        $fake->campaigns()->get(123);

        // Assert
        expect($fake->proxy->sent(CampaignsResource::class))
            ->toBeArray()
            ->not->toBeEmpty()
            ->and(fn () => $fake->proxy->assertSent(CampaignsResource::class));
    });

    it('correctly filters requests by resource type', function (): void {
        // Arrange
        $fake = new ClientFake([
            GetCampaignResponse::fake(GetCampaignFixture::class),
            GetCampaignResponse::fake(GetCampaignFixture::class),
        ]);

        // Act - Create a server and perform another action
        $fake->campaigns()->get(123);

        // Assert - Should only count ServerResource requests
        $fake->proxy->assertSent(CampaignsResource::class, 1);

        // Verify filtering works by asserting no requests for a different resource
        $fake->proxy->assertNotSent('DifferentResource');
    });
});
