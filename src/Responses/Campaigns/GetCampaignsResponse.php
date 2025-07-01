<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetCampaignResponseSchema from GetCampaignResponse
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 *
 * @phpstan-type GetCampaignsResponseSchema array{
 *     data: GetCampaignResponseSchema[],
 *     links: LinksResponseSchema,
 *     meta: MetaResponseSchema
 * }
 *
 * @implements ResponseContract<GetCampaignsResponseSchema>
 */
final readonly class GetCampaignsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetCampaignResponse[]  $data
     */
    public function __construct(
        public array $data,
        public LinksResponse $links,
        public MetaResponse $meta,
    ) {
        //
    }

    /**
     * @param  GetCampaignsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetCampaignResponse => GetCampaignResponse::from($item), $attributes['data']),
            LinksResponse::from($attributes['links']),
            MetaResponse::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetCampaignResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
