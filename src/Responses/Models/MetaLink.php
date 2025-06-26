<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type MetaLinkSchema array{
 *     url: ?string,
 *     label: string,
 *     active: bool,
 * }
 *
 * @implements ResponseContract<MetaLinkSchema>
 */
final readonly class MetaLink implements ResponseContract
{
    /**
     * @use ArrayAccessible<MetaLinkSchema>
     */
    use ArrayAccessible;

    public function __construct(
        public ?string $url,
        public string $label,
        public bool $active
    ) {
        //
    }

    /**
     * @param  MetaLinkSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['url'],
            $attributes['label'],
            $attributes['active']
        );
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'label' => $this->label,
            'active' => $this->active,
        ];
    }
}
