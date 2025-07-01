<?php

declare(strict_types=1);

namespace Givebutter\Responses\Plans;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Concerns\HasErrorMessaging;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetPlanResponseSchema array{
 *     id?: ?string,
 *     first_name?: ?string,
 *     last_name?: ?string,
 *     email?: ?string,
 *     phone?: ?string,
 *     frequency?: ?string,
 *     status?: ?string,
 *     method?: ?string,
 *     amount?: ?int,
 *     fee_covered?: ?int,
 *     created_at?: ?string,
 *     started_at?: ?string,
 *     next_start_date?: ?string,
 *     message?: ?string
 * }
 *
 * @implements ResponseContract<GetPlanResponseSchema>
 */
final readonly class GetPlanResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetPlanResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetPlanResponseSchema>
     */
    use Fakeable;

    use HasErrorMessaging;

    public function __construct(
        public ?string $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $email,
        public ?string $phone,
        public ?string $frequency,
        public ?string $status,
        public ?string $method,
        public ?int $amount,
        public ?int $feeCovered,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $startedAt,
        public ?CarbonImmutable $nextStartDate,
        public ?string $message
    ) {
        //
    }

    /**
     * @param  GetPlanResponseSchema  $attributes
     */
    public static function from(array $attributes): static
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['first_name'] ?? null,
            $attributes['last_name'] ?? null,
            $attributes['email'] ?? null,
            $attributes['phone'] ?? null,
            $attributes['frequency'] ?? null,
            $attributes['status'] ?? null,
            $attributes['method'] ?? null,
            $attributes['amount'] ?? null,
            $attributes['fee_covered'] ?? null,
            isset($attributes['created_at']) ? CarbonImmutable::parse($attributes['created_at']) : null,
            isset($attributes['started_at']) ? CarbonImmutable::parse($attributes['started_at']) : null,
            isset($attributes['next_start_date']) ? CarbonImmutable::parse($attributes['next_start_date']) : null,
            $attributes['message'] ?? null,
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
            'frequency' => $this->frequency,
            'status' => $this->status,
            'method' => $this->method,
            'amount' => $this->amount,
            'fee_covered' => $this->feeCovered,
            'created_at' => $this->createdAt?->toIso8601String(),
            'started_at' => $this->startedAt?->toIso8601String(),
            'next_start_date' => $this->nextStartDate?->toIso8601String(),
            'message' => $this->message,
        ];
    }
}
