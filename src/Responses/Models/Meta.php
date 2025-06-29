<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type MetaLinkSchema from MetaLink
 *
 * @phpstan-type MetaSchema array{
 *     current_page: int,
 *     from: ?int,
 *     last_page: int,
 *     path: string,
 *     per_page: int,
 *     to: ?int,
 *     total: int,
 *     unfiltered_total?: ?int,
 *     links: MetaLinkSchema[]
 * }
 *
 * @implements ResponseContract<MetaSchema>
 */
final readonly class Meta implements ResponseContract
{
    /**
     * @use ArrayAccessible<MetaSchema>
     */
    use ArrayAccessible;

    /**
     * @param  MetaLink[]  $links
     */
    public function __construct(
        public int $currentPage,
        public ?int $from,
        public int $lastPage,
        public string $path,
        public int $perPage,
        public ?int $to,
        public int $total,
        public ?int $unfilteredTotal,
        public array $links
    ) {
        //
    }

    /**
     * @param  MetaSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['current_page'],
            $attributes['from'],
            $attributes['last_page'],
            $attributes['path'],
            $attributes['per_page'],
            $attributes['to'],
            $attributes['total'],
            $attributes['unfiltered_total'] ?? null,
            array_map(static fn (array $link): MetaLink => MetaLink::from($link), $attributes['links']),
        );
    }

    public function toArray(): array
    {
        return [
            'current_page' => $this->currentPage,
            'from' => $this->from,
            'last_page' => $this->lastPage,
            'path' => $this->path,
            'per_page' => $this->perPage,
            'to' => $this->to,
            'total' => $this->total,
            'unfiltered_total' => $this->unfilteredTotal,
            'links' => array_map(static fn (MetaLink $link): array => $link->toArray(), $this->links),
        ];
    }
}
