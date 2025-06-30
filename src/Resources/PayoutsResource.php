<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetPayoutResponseSchema from \Givebutter\Responses\Payouts\GetPayoutResponse
 * @phpstan-import-type GetPayoutsResponseSchema from \Givebutter\Responses\Payouts\GetPayoutsResponse
 */
final class PayoutsResource implements PayoutsResourceContract
{
    public string $resource {
        get {
            return 'payouts';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function list(): \Givebutter\Responses\Payouts\GetPayoutsResponse
    {
        $request = ClientRequestBuilder::get($this->resource);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetPayoutsResponseSchema $data */
        $data = $response->data();

        return \Givebutter\Responses\Payouts\GetPayoutsResponse::from($data);
    }

    public function get(string $id): \Givebutter\Responses\Payouts\GetPayoutResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetPayoutResponseSchema $data */
        $data = $response->data();

        return \Givebutter\Responses\Payouts\GetPayoutResponse::from($data);
    }
}
