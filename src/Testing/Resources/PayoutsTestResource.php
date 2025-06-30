<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Resources\PayoutsResource;
use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Responses\Payouts\GetPayoutsResponse;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetPayoutResponseSchema from GetPayoutResponse
 * @phpstan-import-type GetPayoutsResponseSchema from GetPayoutsResponse
 *
 * @phpstan-type PayoutsResponseSchema GetPayoutResponseSchema|GetPayoutsResponseSchema
 */
final class PayoutsTestResource implements PayoutsResourceContract
{
    /**
     * @use Testable<PayoutsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return PayoutsResource::class;
        }
    }

    public function get(string $id): GetPayoutResponse
    {
        /** @var GetPayoutResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(?string $scope = null): GetPayoutsResponse
    {
        /** @var GetPayoutsResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
