<?php

declare(strict_types=1);

namespace Givebutter\Responses\Funds;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Concerns\HasErrors;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-type GetFundResponseSchema array{
 *     id?: ?string,
 *     code?: ?string,
 *     name?: ?string,
 *     raised?: ?int,
 *     supporters?: ?int,
 *     created_at?: ?string,
 *     updated_at?: ?string,
 *     message?: ?string,
 *     errors?: ?array<string, string[]>
 * }
 *
 * @implements ResponseContract<GetFundResponseSchema>
 */
final readonly class GetFundResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetFundResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetFundResponseSchema>
     */
    use Fakeable;

    use HasErrors;

    /**
     * @param  null|array<string, string[]>  $errors
     */
    private function __construct(
        public ?string $id,
        public ?string $code,
        public ?string $name,
        public ?int $raised,
        public ?int $supporters,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $updatedAt,
        public ?string $message,
        public ?array $errors,
    ) {
        //
    }

    /**
     * @param  GetFundResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['code'] ?? null,
            $attributes['name'] ?? null,
            $attributes['raised'] ?? null,
            $attributes['supporters'] ?? null,
            isset($attributes['created_at']) ? CarbonImmutable::parse($attributes['created_at']) : null,
            isset($attributes['updated_at']) ? CarbonImmutable::parse($attributes['updated_at']) : null,
            $attributes['message'] ?? null,
            $attributes['errors'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'raised' => $this->raised,
            'supporters' => $this->supporters,
            'created_at' => $this->createdAt?->toIso8601String(),
            'updated_at' => $this->updatedAt?->toIso8601String(),
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
