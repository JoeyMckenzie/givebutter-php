<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type RecipientSchema array{name: ?string, email: ?string}
 * @phpstan-type DedicationSchema array{
 *     type: string,
 *     name: string,
 *     recipient: RecipientSchema
 * }
 *
 * @implements ResponseContract<DedicationSchema>
 */
final readonly class Dedication implements ResponseContract
{
    /**
     * @use ArrayAccessible<DedicationSchema>
     */
    use ArrayAccessible;

    /**
     * @param  RecipientSchema  $recipient
     */
    public function __construct(
        public string $type,
        public string $name,
        public array $recipient,
    ) {
        //
    }

    /**
     * @param  DedicationSchema  $attributes
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
