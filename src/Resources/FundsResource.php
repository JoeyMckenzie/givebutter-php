<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Responses\Funds\GetFundsResponse;
use Psr\Http\Message\ResponseInterface;
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

    public function create(string $name, ?string $code = null): GetFundResponse
    {
        $request = ClientRequestBuilder::post($this->resource)
            ->withRequestContent([
                'name' => $name,
                'code' => $code,
            ]);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetFundResponseSchema $data */
        $data = $response->data();

        return GetFundResponse::from($data);
    }

    public function update(string $id, string $name, ?string $code = null): GetFundResponse
    {
        $request = ClientRequestBuilder::patch("$this->resource/$id")
            ->withRequestContent([
                'name' => $name,
                'code' => $code,
            ]);

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetFundResponseSchema $data */
        $data = $response->data();

        return GetFundResponse::from($data);
    }

    public function delete(string $id): ResponseInterface
    {
        $request = ClientRequestBuilder::delete("$this->resource/$id");

        return $this->connector->sendStandardClientRequest($request);
    }
}
