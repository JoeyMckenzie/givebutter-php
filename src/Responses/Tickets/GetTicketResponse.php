<?php

declare(strict_types=1);

namespace Givebutter\Responses\Tickets;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Concerns\HasErrorMessaging;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetTicketResponseSchema array{
 *     id?: ?string,
 *     id_suffix?: ?string,
 *     name?: ?string,
 *     first_name?: ?string,
 *     last_name?: ?string,
 *     email?: ?string,
 *     phone?: ?string,
 *     title?: ?string,
 *     description?: ?string,
 *     price?: ?int,
 *     pdf?: ?string,
 *     arrived_at?: ?string,
 *     created_at?: ?string,
 *     message?: ?string
 * }
 *
 * @implements ResponseContract<GetTicketResponseSchema>
 */
final readonly class GetTicketResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetTicketResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetTicketResponseSchema>
     */
    use Fakeable;

    use HasErrorMessaging;

    public function __construct(
        public ?string $id,
        public ?string $idSuffix,
        public ?string $name,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $email,
        public ?string $phone,
        public ?string $title,
        public ?string $description,
        public ?int $price,
        public ?string $pdf,
        public ?CarbonImmutable $arrivedAt,
        public ?CarbonImmutable $createdAt,
        public ?string $message
    ) {
        //
    }

    /**
     * @param  GetTicketResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['id_suffix'] ?? null,
            $attributes['name'] ?? null,
            $attributes['first_name'] ?? null,
            $attributes['last_name'] ?? null,
            $attributes['email'] ?? null,
            $attributes['phone'] ?? null,
            $attributes['title'] ?? null,
            $attributes['description'] ?? null,
            $attributes['price'] ?? null,
            $attributes['pdf'] ?? null,
            isset($attributes['arrived_at']) ? CarbonImmutable::parse($attributes['arrived_at']) : null,
            isset($attributes['created_at']) ? CarbonImmutable::parse($attributes['created_at']) : null,
            $attributes['message'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_suffix' => $this->idSuffix,
            'name' => $this->name,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'pdf' => $this->pdf,
            'arrived_at' => $this->arrivedAt?->toIso8601String(),
            'created_at' => $this->createdAt?->toIso8601String(),
            'message' => $this->message,
        ];
    }
}
