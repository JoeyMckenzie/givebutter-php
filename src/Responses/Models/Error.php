<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type ErrorSchema array{
 *     message: string,
 *     errors?: array<string, string[]>
 * }
 *
 * @implements ResponseContract<ErrorSchema>
 */
final readonly class Error implements ResponseContract
{
    /**
     * @use ArrayAccessible<ErrorSchema>
     */
    use ArrayAccessible;

    /**
     * @param  null|array<string, string[]>  $errors
     */
    public function __construct(
        public string $message,
        public ?array $errors
    ) {
        //
    }

    /**
     * @param  ErrorSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['message'],
            $attributes['errors'] ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'errors' => $this->errors ?? [],
        ];
    }
}
