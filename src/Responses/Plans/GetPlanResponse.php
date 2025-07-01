<?php

declare(strict_types=1);

namespace Givebutter\Responses\Plans;

use Carbon\CarbonImmutable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetPlanResponseSchema array{
 *     id: string,
 *     first_name: string,
 *     last_name: string,
 *     email: string,
 *     phone: string,
 *     frequency: string,
 *     status: string,
 *     method: string,
 *     amount: int,
 *     fee_covered: int,
 *     created_at: string,
 *     started_at: string,
 *     next_start_date: string,
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

    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $frequency,
        public string $status,
        public string $method,
        public int $amount,
        public int $feeCovered,
        public CarbonImmutable $createdAt,
        public CarbonImmutable $startedAt,
        public CarbonImmutable $nextStartDate,
    ) {
        //
    }

    /**
     * @param  GetPlanResponseSchema  $attributes
     */
    public static function from(array $attributes): static
    {
        return new self(
            $attributes['id'],
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['phone'],
            $attributes['frequency'],
            $attributes['status'],
            $attributes['method'],
            $attributes['amount'],
            $attributes['fee_covered'],
            CarbonImmutable::parse($attributes['created_at']),
            CarbonImmutable::parse($attributes['started_at']),
            CarbonImmutable::parse($attributes['next_start_date']),
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
            'created_at' => $this->createdAt->toIso8601String(),
            'started_at' => $this->startedAt->toIso8601String(),
            'next_start_date' => $this->nextStartDate->toIso8601String(),
        ];
    }
}
