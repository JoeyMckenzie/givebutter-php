<?php

declare(strict_types=1);

namespace Givebutter\Responses\Models;

use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type MetaLinkResponseSchema from MetaLinkResponse
 *
 * @phpstan-type MetaResponseSchema array{
 *     current_page: int,
 *     from: ?int,
 *     last_page: int,
 *     path: string,
 *     per_page: int,
 *     to: ?int,
 *     total: int,
 *     unfiltered_total?: ?int,
 *     links: MetaLinkResponseSchema[]
 * }
 *
 * @implements ResponseContract<MetaResponseSchema>
 */
final readonly class MetaResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<MetaResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @param  MetaLinkResponse[]  $links
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
     * @param  MetaResponseSchema  $attributes
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
            array_map(static fn (array $link): MetaLinkResponse => MetaLinkResponse::from($link), $attributes['links']),
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
            'links' => array_map(static fn (MetaLinkResponse $link): array => $link->toArray(), $this->links),
        ];
    }
}
