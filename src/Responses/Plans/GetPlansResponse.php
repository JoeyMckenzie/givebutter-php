<?php

declare(strict_types=1);

namespace Givebutter\Responses\Plans;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetPlanResponseSchema from GetPlanResponse
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 *
 * @phpstan-type GetPlansResponseSchema array{
 *     data: GetPlanResponseSchema[],
 *     links: LinksResponseSchema,
 *     meta: MetaResponseSchema
 * }
 *
 * @implements ResponseContract<GetPlansResponseSchema>
 */
final readonly class GetPlansResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetPlansResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetPlansResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetPlanResponse[]  $data
     */
    public function __construct(
        public array $data,
        public LinksResponse $links,
        public MetaResponse $meta,
    ) {
        //
    }

    /**
     * @param  GetPlansResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetPlanResponse => GetPlanResponse::from($item), $attributes['data']),
            LinksResponse::from($attributes['links']),
            MetaResponse::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetPlanResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
