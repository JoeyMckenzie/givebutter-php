<?php

declare(strict_types=1);

namespace Givebutter\Resources;

use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Responses\Plans\GetPlanResponse;
use Givebutter\Responses\Plans\GetPlansResponse;
use Wrapkit\Contracts\ConnectorContract;
use Wrapkit\Support\ClientRequestBuilder;
use Wrapkit\ValueObjects\Response;

/**
 * @phpstan-import-type GetPlanResponseSchema from GetPlanResponse
 * @phpstan-import-type GetPlansResponseSchema from GetPlansResponse
 */
final class PlansResource implements PlansResourceContract
{
    public string $resource {
        get {
            return 'plans';
        }
    }

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function list(): GetPlansResponse
    {
        $request = ClientRequestBuilder::get("$this->resource");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetPlansResponseSchema $data */
        $data = $response->data();

        return GetPlansResponse::from($data);
    }

    public function get(string $id): GetPlanResponse
    {
        $request = ClientRequestBuilder::get("$this->resource/$id");

        /** @var Response<array<array-key, mixed>> $response */
        $response = $this->connector->sendClientRequest($request);

        /** @var GetPlanResponseSchema $data */
        $data = $response->data();

        return GetPlanResponse::from($data);
    }
}
