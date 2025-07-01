<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Concerns\HasErrorMessaging;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetCampaignTeamResponseSchema array{
 *     id?: ?int,
 *     name?: ?string,
 *     logo?: ?string,
 *     slug?: ?string,
 *     url?: ?string,
 *     raised?: ?int,
 *     goal?: ?int,
 *     supporters?: ?int,
 *     members?: ?int,
 *     message?: ?string,
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

    use HasErrorMessaging;

    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $logo,
        public ?string $slug,
        public ?string $url,
        public ?int $raised,
        public ?int $goal,
        public ?int $supporters,
        public ?int $members,
        public ?string $message
    ) {
        //
    }

    /**
     * @param  GetCampaignTeamResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['name'] ?? null,
            $attributes['logo'] ?? null,
            $attributes['slug'] ?? null,
            $attributes['url'] ?? null,
            $attributes['raised'] ?? null,
            $attributes['goal'] ?? null,
            $attributes['supporters'] ?? null,
            $attributes['members'] ?? null,
            $attributes['message'] ?? null
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
            'message' => $this->message,
        ];
    }
}
