<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type CustomFieldResponseSchema array{
 *     id: int,
 *     field_id: int,
 *     title: string,
 *     description: string,
 *     type: string,
 *     value: string
 * }
 *
 * @implements ResponseContract<CustomFieldResponseSchema>
 */
final readonly class CustomFieldResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<CustomFieldResponseSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public int $id,
        public int $fieldId,
        public string $title,
        public string $description,
        public string $type,
        public string $value
    ) {
        //
    }

    /**
     * @param  CustomFieldResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['field_id'],
            $attributes['title'],
            $attributes['description'],
            $attributes['type'],
            $attributes['value']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'field_id' => $this->fieldId,
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
