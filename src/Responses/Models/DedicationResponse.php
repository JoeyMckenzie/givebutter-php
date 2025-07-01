<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type RecipientResponseSchema array{name: ?string, email: ?string}
 * @phpstan-type DedicationResponseSchema array{
 *     type: string,
 *     name: string,
 *     recipient: RecipientResponseSchema
 * }
 *
 * @implements ResponseContract<DedicationResponseSchema>
 */
final readonly class DedicationResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<DedicationResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @param  RecipientResponseSchema  $recipient
     */
    public function __construct(
        public string $type,
        public string $name,
        public array $recipient,
    ) {
        //
    }

    /**
     * @param  DedicationResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
            $attributes['recipient'],
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'recipient' => $this->recipient,
        ];
    }
}
