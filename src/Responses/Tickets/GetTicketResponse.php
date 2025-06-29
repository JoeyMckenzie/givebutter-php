<?php

declare(strict_types=1);

namespace Givebutter\Responses\Tickets;

use Carbon\CarbonImmutable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetTicketResponseSchema array{
 *     id: string,
 *     id_suffix: string,
 *     name: string,
 *     first_name: string,
 *     last_name: string,
 *     email: string,
 *     phone: string,
 *     title: string,
 *     description: string,
 *     price: int,
 *     pdf: string,
 *     arrived_at: string,
 *     created_at: string
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

    public function __construct(
        public string $id,
        public string $idSuffix,
        public string $name,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $title,
        public string $description,
        public int $price,
        public string $pdf,
        public CarbonImmutable $arrivedAt,
        public CarbonImmutable $createdAt,
    ) {
        //
    }

    /**
     * @param  GetTicketResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['id_suffix'],
            $attributes['name'],
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['phone'],
            $attributes['title'],
            $attributes['description'],
            $attributes['price'],
            $attributes['pdf'],
            CarbonImmutable::parse($attributes['arrived_at']),
            CarbonImmutable::parse($attributes['created_at']),
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
            'arrived_at' => $this->arrivedAt->toIso8601String(),
            'created_at' => $this->createdAt->toIso8601String(),
        ];
    }
}
