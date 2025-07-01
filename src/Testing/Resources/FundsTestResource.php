<?php

declare(strict_types=1);

namespace Givebutter\Testing\Resources;

use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Resources\FundsResource;
use Givebutter\Responses\Funds\GetFundResponse;
use Givebutter\Responses\Funds\GetFundsResponse;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Testing\Concerns\Testable;

/**
 * @phpstan-import-type GetFundResponseSchema from GetFundResponse
 *
 * @phpstan-type FundsResponseSchema GetFundResponseSchema
 */
final class FundsTestResource implements FundsResourceContract
{
    /**
     * @use Testable<FundsResponseSchema>
     */
    use Testable;

    public string $resource {
        get {
            return FundsResource::class;
        }
    }

    public function get(string $id): GetFundResponse
    {
        /** @var GetFundResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function list(): GetFundsResponse
    {
        /** @var GetFundsResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function create(string $name, ?string $code = null): GetFundResponse
    {
        /** @var GetFundResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function update(string $id, string $name, ?string $code = null): GetFundResponse
    {
        /** @var GetFundResponse $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }

    public function delete(string $id): ResponseInterface
    {
        /** @var ResponseInterface $response */
        $response = $this->record(__FUNCTION__, func_get_args());

        return $response;
    }
}
