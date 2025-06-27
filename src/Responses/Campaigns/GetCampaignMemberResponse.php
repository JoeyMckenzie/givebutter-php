<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetCampaignMemberResponseSchema array{
 *     id: int,
 *     first_name: string,
 *     last_name: string,
 *     email: string,
 *     phone: string,
 *     display_name: string,
 *     picture: string,
 *     raised: int,
 *     goal: int,
 *     donors: int,
 *     items: int,
 *     url: string,
 * }
 *
 * @implements ResponseContract<GetCampaignMemberResponseSchema>
 */
final readonly class GetCampaignMemberResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignMemberResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignMemberResponseSchema>
     */
    use Fakeable;

    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $displayName,
        public string $picture,
        public int $raised,
        public int $goal,
        public int $donors,
        public int $items,
        public string $url,
    ) {
        //
    }

    /**
     * @param  GetCampaignMemberResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['phone'],
            $attributes['display_name'],
            $attributes['picture'],
            $attributes['raised'],
            $attributes['goal'],
            $attributes['donors'],
            $attributes['items'],
            $attributes['url'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'display_name' => $this->displayName,
            'picture' => $this->picture,
            'raised' => $this->raised,
            'goal' => $this->goal,
            'donors' => $this->donors,
            'items' => $this->items,
            'url' => $this->url,
        ];
    }
}
