<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetCampaignSchema from GetCampaignResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetCampaignsSchema array{
 *     data: GetCampaignSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
 * }
 *
 * @implements ResponseContract<GetCampaignsSchema>
 */
final readonly class GetCampaignsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignsSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignsSchema>
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
     * @param  GetCampaignsSchema  $attributes
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
            'data' => array_map(static fn (GetCampaignResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore-line
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
