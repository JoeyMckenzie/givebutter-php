<?php

declare(strict_types=1);

namespace Givebutter\Responses\Payouts;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetPayoutResponseSchema from GetPayoutResponse
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 *
 * @phpstan-type GetPayoutsResponseSchema array{
 *     data: GetPayoutResponseSchema[],
 *     links: LinksResponseSchema,
 *     meta: MetaResponseSchema
 * }
 *
 * @implements ResponseContract<GetPayoutsResponseSchema>
 */
final readonly class GetPayoutsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetPayoutsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetPayoutsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetPayoutResponse[]  $data
     */
    public function __construct(
        public array $data,
        public LinksResponse $links,
        public MetaResponse $meta,
    ) {
        //
    }

    /**
     * @param  GetPayoutsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetPayoutResponse => GetPayoutResponse::from($item), $attributes['data']),
            LinksResponse::from($attributes['links']),
            MetaResponse::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetPayoutResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
