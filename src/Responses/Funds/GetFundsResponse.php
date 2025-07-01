<?php

declare(strict_types=1);

namespace Givebutter\Responses\Funds;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 * @phpstan-import-type GetFundResponseSchema from GetFundResponse
 *
 * @phpstan-type GetFundsResponseSchema array{
 *     data: GetFundResponseSchema[],
 *     links: LinksResponseSchema,
 *     meta: MetaResponseSchema
 * }
 *
 * @implements ResponseContract<GetFundsResponseSchema>
 */
final readonly class GetFundsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetFundsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetFundsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetFundResponse[]  $data
     */
    private function __construct(
        public array $data,
        public LinksResponse $links,
        public MetaResponse $meta,
    ) {
        //
    }

    /**
     * @param  GetFundsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetFundResponse => GetFundResponse::from($item), $attributes['data']),
            LinksResponse::from($attributes['links']),
            MetaResponse::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetFundResponse $response): array => $response->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
