<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Responses\Payouts\GetPayoutResponse;
use Givebutter\Responses\Payouts\GetPayoutsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetPayoutResponseSchema from GetPayoutResponse
 * @phpstan-import-type GetPayoutsResponseSchema from GetPayoutsResponse
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

    public function list(): GetPayoutsResponse
    {
        $request = ClientRequestBuilder::get($this->resource);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetPayoutsResponseSchema $data */
        $data = $response->data();

        return GetPayoutsResponse::from($data);
    }

    public function get(string $id): GetPayoutResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetPayoutResponseSchema $data */
        $data = $response->data();

        return GetPayoutResponse::from($data);
    }
}
