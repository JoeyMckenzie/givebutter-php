<?php

declare(strict_types=1);

namespace Givebutter\Responses\Campaigns;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Concerns\HasErrors;
use Givebutter\Responses\Models\CoverResponse;
use Givebutter\Responses\Models\EventResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type CoverResponseSchema from CoverResponse
 * @phpstan-import-type EventResponseSchema from EventResponse
 *
 * @phpstan-type GetCampaignResponseSchema array{
 *     id?: ?int,
 *     code?: ?string,
 *     account_id?: ?string,
 *     event_id?: ?int,
 *     type?: ?string,
 *     title?: ?string,
 *     subtitle?: ?string,
 *     description?: ?string,
 *     slug?: ?string,
 *     url?: ?string,
 *     goal?: ?int,
 *     raised?: ?int,
 *     donors?: ?int,
 *     currency?: ?string,
 *     cover?: ?CoverResponseSchema,
 *     status?: ?string,
 *     timezone?: ?string,
 *     end_at?: ?string,
 *     created_at?: ?string,
 *     updated_at?: ?string,
 *     event?: ?EventResponseSchema,
 *     message?: ?string,
 *     errors: ?array<string, string[]>
 * }
 *
 * @implements ResponseContract<GetCampaignResponseSchema>
 */
final readonly class GetCampaignResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetCampaignResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetCampaignResponseSchema>
     */
    use Fakeable;

    use HasErrors;

    /**
     * @param  null|array<string, string[]>  $errors
     */
    public function __construct(
        public ?int $id,
        public ?string $code,
        public ?string $accountId,
        public ?int $eventId,
        public ?string $type,
        public ?string $title,
        public ?string $subtitle,
        public ?string $description,
        public ?string $slug,
        public ?string $url,
        public ?int $goal,
        public ?int $raised,
        public ?int $donors,
        public ?string $currency,
        public ?CoverResponse $cover,
        public ?string $status,
        public ?string $timezone,
        public ?CarbonImmutable $endAt,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $updatedAt,
        public ?EventResponse $event,
        public ?string $message,
        public ?array $errors,
    ) {
        //
    }

    /**
     * @param  GetCampaignResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['code'] ?? null,
            $attributes['account_id'] ?? null,
            $attributes['event_id'] ?? null,
            $attributes['type'] ?? null,
            $attributes['title'] ?? null,
            $attributes['subtitle'] ?? null,
            $attributes['description'] ?? null,
            $attributes['slug'] ?? null,
            $attributes['url'] ?? null,
            $attributes['goal'] ?? null,
            $attributes['raised'] ?? null,
            $attributes['donors'] ?? null,
            $attributes['currency'] ?? null,
            isset($attributes['cover']) ? CoverResponse::from($attributes['cover']) : null,
            $attributes['status'] ?? null,
            $attributes['timezone'] ?? null,
            isset($attributes['end_at']) ? CarbonImmutable::parse($attributes['end_at']) : null,
            isset($attributes['created_at']) ? CarbonImmutable::parse($attributes['created_at']) : null,
            isset($attributes['updated_at']) ? CarbonImmutable::parse($attributes['updated_at']) : null,
            isset($attributes['event']) ? EventResponse::from($attributes['event']) : null,
            $attributes['message'] ?? null,
            $attributes['errors'] ?? null,
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
            'created_at' => $this->createdAt?->toIso8601String(),
            'updated_at' => $this->updatedAt?->toIso8601String(),
            'event' => $this->event?->toArray(),
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
