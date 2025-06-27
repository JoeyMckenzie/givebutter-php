<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetCampaignTeamResponseSchema from GetCampaignTeamResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetCampaignTeamsResponseSchema array{
 *     data: GetCampaignTeamResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
 * }
 *
 * @implements ResponseContract<GetCampaignTeamsResponseSchema>
 */
final readonly class GetCampaignTeamsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignTeamsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignTeamsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetCampaignTeamResponse[]  $data
     */
    public function __construct(
        public array $data,
        public Links $links,
        public Meta $meta,
    ) {
        //
    }

    /**
     * @param  GetCampaignTeamsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetCampaignTeamResponse => GetCampaignTeamResponse::from($item), $attributes['data']),
            Links::from($attributes['links']),
            Meta::from($attributes['meta'])
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetCampaignTeamResponse $item): array => $item->toArray(), $this->data),
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
