<?php

declare(strict_types=1);

namespace Givebutter\Responses\Tickets;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetTicketResponseSchema from GetTicketResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetTicketsResponseSchema array{
 *     data: GetTicketResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
 * }
 *
 * @implements ResponseContract<GetTicketsResponseSchema>
 */
final readonly class GetTicketsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetTicketsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetTicketsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetTicketResponse[]  $data
     */
    public function __construct(
        public array $data,
        public Links $links,
        public Meta $meta,
    ) {
        //
    }

    /**
     * @param  GetTicketsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetTicketResponse => GetTicketResponse::from($item), $attributes['data']),
            Links::from($attributes['links']),
            Meta::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetTicketResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
