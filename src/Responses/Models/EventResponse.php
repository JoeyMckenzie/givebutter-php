<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Carbon\CarbonImmutable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type LivestreamResponseSchema from LivestreamResponse
 *
 * @phpstan-type EventResponseSchema array{
 *     title: string,
 *     type: string,
 *     location_name: string,
 *     address_formatted: string,
 *     google_place_id: string,
 *     start_at: string,
 *     end_at: string,
 *     timezone: string,
 *     details: string,
 *     private: bool,
 *     tickets_required: bool,
 *     livestream: LivestreamResponseSchema,
 *     livestream_start_at: string,
 *     livestream_end_at: string,
 * }
 *
 * @implements ResponseContract<EventResponseSchema>
 */
final readonly class EventResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<EventResponseSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public string $title,
        public string $type,
        public string $locationName,
        public string $addressFormatted,
        public string $googlePlaceId,
        public CarbonImmutable $startAt,
        public CarbonImmutable $endAt,
        public string $timezone,
        public string $details,
        public bool $private,
        public bool $ticketsRequired,
        public LivestreamResponse $livestream,
        public CarbonImmutable $livestreamStartAt,
        public CarbonImmutable $livestreamEndAt,
    ) {
        //
    }

    /**
     * @param  EventResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['title'],
            $attributes['type'],
            $attributes['location_name'],
            $attributes['address_formatted'],
            $attributes['google_place_id'],
            CarbonImmutable::parse($attributes['start_at']),
            CarbonImmutable::parse($attributes['end_at']),
            $attributes['timezone'],
            $attributes['details'],
            $attributes['private'],
            $attributes['tickets_required'],
            LivestreamResponse::from($attributes['livestream']),
            CarbonImmutable::parse($attributes['livestream_start_at']),
            CarbonImmutable::parse($attributes['livestream_end_at']),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'location_name' => $this->locationName,
            'address_formatted' => $this->addressFormatted,
            'google_place_id' => $this->googlePlaceId,
            'start_at' => $this->startAt->toIso8601String(),
            'end_at' => $this->endAt->toIso8601String(),
            'timezone' => $this->timezone,
            'details' => $this->details,
            'private' => $this->private,
            'tickets_required' => $this->ticketsRequired,
            'livestream' => $this->livestream->toArray(),
            'livestream_start_at' => $this->livestreamStartAt->toIso8601String(),
            'livestream_end_at' => $this->livestreamEndAt->toIso8601String(),
        ];
    }
}
