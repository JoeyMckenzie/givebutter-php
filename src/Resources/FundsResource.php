<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Responses\Funds\GetFundsResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetFundResponseSchema from GetFundResponse
 * @phpstan-import-type GetFundsResponseSchema from GetFundsResponse
 */
final class FundsResource implements FundsResourceContract
{
    public string $resource {
        get {
            return 'funds';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function list(): GetFundsResponse
    {
        $request = ClientRequestBuilder::get("$this->resource");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetFundsResponseSchema $data */
        $data = $response->data();

        return GetFundsResponse::from($data);
    }

    public function get(string $id): GetFundResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetFundResponseSchema $data */
        $data = $response->data();

        return GetFundResponse::from($data);
    }
}
