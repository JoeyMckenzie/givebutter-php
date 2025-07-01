<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type ErrorResponseSchema array{
 *     message?: ?string,
 *     errors?: ?array<string, string[]>
 * }
 *
 * @implements ResponseContract<ErrorResponseSchema>
 */
final readonly class ErrorResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<ErrorResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @param  array<string, string[]>  $errors
     */
    public function __construct(
        public ?string $message,
        public ?array $errors
    ) {
        //
    }

    /**
     * @param  ErrorResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['message'] ?? null,
            $attributes['errors'] ?? null
        );
    }

    public static function default(): self
    {
        return new self(null, null);
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
