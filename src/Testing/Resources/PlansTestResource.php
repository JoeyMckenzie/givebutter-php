<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Resources\PlansResource;
use Givebutter\Responses\Plans\GetPlanResponse;
use Givebutter\Responses\Plans\GetPlansResponse;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetPlanResponseSchema from GetPlanResponse
 * @phpstan-import-type GetPlansResponseSchema from GetPlansResponse
 *
 * @phpstan-type PlansResponseSchema GetPlanResponseSchema|GetPlansResponseSchema
 */
final class PlansTestResource implements PlansResourceContract
{
    /**
     * @use Testable<PlansResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return PlansResource::class;
        }
    }

    public function get(string $id): GetPlanResponse
    {
        /** @var GetPlanResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(?string $scope = null): GetPlansResponse
    {
        /** @var GetPlansResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
