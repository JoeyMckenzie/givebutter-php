<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetCampaignResponseSchema from GetCampaignResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetCampaignsResponseSchema array{
 *     data: GetCampaignResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
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
        public Links $links,
        public Meta $meta,
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
            Links::from($attributes['links']),
            Meta::from($attributes['meta']),
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
