<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetCampaignMemberResponseSchema from GetCampaignMemberResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetCampaignMembersResponseSchema array{
 *     data: GetCampaignMemberResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
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
        public Links $links,
        public Meta $meta,
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
            Links::from($attributes['links']),
            Meta::from($attributes['meta'])
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
