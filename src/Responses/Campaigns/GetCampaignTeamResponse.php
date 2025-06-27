<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetCampaignTeamResponseSchema array{
 *     id: int,
 *     name: string,
 *     logo: string,
 *     slug: string,
 *     url: string,
 *     raised: int,
 *     goal: int,
 *     supporters: int,
 *     members: int,
 * }
 *
 * @implements ResponseContract<GetCampaignTeamResponseSchema>
 */
final readonly class GetCampaignTeamResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignTeamResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignTeamResponseSchema>
     */
    use Fakeable;

    public function __construct(
        public int $id,
        public string $name,
        public string $logo,
        public string $slug,
        public string $url,
        public int $raised,
        public int $goal,
        public int $supporters,
        public int $members,
    ) {
        //
    }

    /**
     * @param  GetCampaignTeamResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['name'],
            $attributes['logo'],
            $attributes['slug'],
            $attributes['url'],
            $attributes['raised'],
            $attributes['goal'],
            $attributes['supporters'],
            $attributes['members'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'slug' => $this->slug,
            'url' => $this->url,
            'raised' => $this->raised,
            'goal' => $this->goal,
            'supporters' => $this->supporters,
            'members' => $this->members,
        ];
    }
}
