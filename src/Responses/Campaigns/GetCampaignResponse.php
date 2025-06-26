<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Models\Cover;
use Givebutter\Responses\Models\Event;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type CoverSchema from Cover
 * @phpstan-import-type EventSchema from Event
 *
 * @phpstan-type GetCampaignSchema array{
 *     id: int,
 *     code: string,
 *     account_id: string,
 *     event_id: ?int,
 *     type: string,
 *     title: string,
 *     subtitle: ?string,
 *     description: ?string,
 *     slug: string,
 *     url: string,
 *     goal: ?int,
 *     raised: int,
 *     donors: int,
 *     currency: string,
 *     cover: ?CoverSchema,
 *     status: string,
 *     timezone: string,
 *     end_at: ?string,
 *     created_at: string,
 *     updated_at: string,
 *     event: ?EventSchema
 * }
 *
 * @implements ResponseContract<GetCampaignSchema>
 */
final readonly class GetCampaignResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignSchema>
     */
    use Fakeable;

    public function __construct(
        public int $id,
        public string $code,
        public string $accountId,
        public ?int $eventId,
        public string $type,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public string $slug,
        public string $url,
        public ?int $goal,
        public int $raised,
        public int $donors,
        public string $currency,
        public ?Cover $cover,
        public string $status,
        public string $timezone,
        public ?CarbonImmutable $endAt,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $updatedAt,
        public ?Event $event,
    ) {
        //
    }

    /**
     * @param  GetCampaignSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['code'],
            $attributes['account_id'],
            $attributes['event_id'] ?? null,
            $attributes['type'],
            $attributes['title'],
            $attributes['subtitle'] ?? null,
            $attributes['description'] ?? null,
            $attributes['slug'],
            $attributes['url'],
            $attributes['goal'] ?? null,
            $attributes['raised'],
            $attributes['donors'],
            $attributes['currency'],
            isset($attributes['cover']) ? Cover::from($attributes['cover']) : null,
            $attributes['status'],
            $attributes['timezone'],
            isset($attributes['end_at']) ? CarbonImmutable::parse($attributes['end_at']) : null,
            CarbonImmutable::parse($attributes['created_at']),
            CarbonImmutable::parse($attributes['updated_at']),
            isset($attributes['event']) ? Event::from($attributes['event']) : null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'account_id' => $this->accountId,
            'event_id' => $this->eventId,
            'type' => $this->type,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'slug' => $this->slug,
            'url' => $this->url,
            'goal' => $this->goal,
            'raised' => $this->raised,
            'donors' => $this->donors,
            'currency' => $this->currency,
            'cover' => $this->cover?->toArray(),
            'status' => $this->status,
            'timezone' => $this->timezone,
            'end_at' => $this->endAt?->toIso8601String(),
            'created_at' => $this->createdAt->toIso8601String(),
            'updated_at' => $this->updatedAt->toIso8601String(),
            'event' => $this->event?->toArray(),
        ];
    }
}
