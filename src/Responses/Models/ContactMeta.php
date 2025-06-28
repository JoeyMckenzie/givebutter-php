<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type ContactMetaSchema array{
 *     type: string,
 *     value: string
 * }
 *
 * @implements ResponseContract<ContactMetaSchema>
 */
final readonly class ContactMeta implements ResponseContract
{
    /**
     * @use ArrayAccessible<ContactMetaSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public string $type,
        public string $value
    ) {
        //
    }

    /**
     * @param  ContactMetaSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['value']
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
