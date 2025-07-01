<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetCampaignMemberResponseSchema from GetCampaignMemberResponse
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 *
 * @phpstan-type GetCampaignMembersResponseSchema array{
 *     data: GetCampaignMemberResponseSchema[],
 *     links: LinksResponseSchema,
 *     meta: MetaResponseSchema
 * }
 *
 * @implements ResponseContract<GetCampaignMembersResponseSchema>
 */
final readonly class GetCampaignMembersResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignMembersResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignMembersResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetCampaignMemberResponse[]  $data
     */
    public function __construct(
        public array $data,
        public LinksResponse $links,
        public MetaResponse $meta,
    ) {
        //
    }

    /**
     * @param  GetCampaignMembersResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetCampaignMemberResponse => GetCampaignMemberResponse::from($item), $attributes['data']),
            LinksResponse::from($attributes['links']),
            MetaResponse::from($attributes['meta'])
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetCampaignMemberResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
