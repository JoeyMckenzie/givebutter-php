<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Givebutter\Responses\Concerns\Fallible;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetCampaignMemberResponseSchema array{
 *     id?: ?int,
 *     first_name?: ?string,
 *     last_name?: ?string,
 *     email?: ?string,
 *     phone?: ?string,
 *     display_name?: ?string,
 *     picture?: ?string,
 *     raised?: ?int,
 *     goal?: ?int,
 *     donors?: ?int,
 *     items?: ?int,
 *     url?: ?string,
 *     message?: ?string,
 *     errors?: ?array<string, string[]>
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

    use Fallible;

    /**
     * @param  null|array<string, string[]>  $errors
     */
    public function __construct(
        public ?int $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $email,
        public ?string $phone,
        public ?string $displayName,
        public ?string $picture,
        public ?int $raised,
        public ?int $goal,
        public ?int $donors,
        public ?int $items,
        public ?string $url,
        public ?string $message,
        public ?array $errors
    ) {
        //
    }

    /**
     * @param  GetCampaignMemberResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['first_name'] ?? null,
            $attributes['last_name'] ?? null,
            $attributes['email'] ?? null,
            $attributes['phone'] ?? null,
            $attributes['display_name'] ?? null,
            $attributes['picture'] ?? null,
            $attributes['raised'] ?? null,
            $attributes['goal'] ?? null,
            $attributes['donors'] ?? null,
            $attributes['items'] ?? null,
            $attributes['url'] ?? null,
            $attributes['message'] ?? null,
            $attributes['errors'] ?? null,
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
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
