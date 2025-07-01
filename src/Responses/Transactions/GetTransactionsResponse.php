<?php

declare(strict_types=1);

namespace Givebutter\Responses\Transactions;

use Givebutter\Responses\Models\LinksResponse;
use Givebutter\Responses\Models\MetaResponse;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetTransactionResponseSchema from GetTransactionResponse
 * @phpstan-import-type MetaResponseSchema from MetaResponse
 * @phpstan-import-type LinksResponseSchema from LinksResponse
 *
 * @phpstan-type GetTransactionsResponseSchema array{
 *     data: GetTransactionResponseSchema[],
 *     links: LinksResponseSchema,
 *     meta: MetaResponseSchema
 * }
 *
 * @implements ResponseContract<GetTransactionsResponseSchema>
 */
final readonly class GetTransactionsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetTransactionsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetTransactionsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetTransactionResponse[]  $data
     */
    public function __construct(
        public array $data,
        public LinksResponse $links,
        public MetaResponse $meta,
    ) {
        //
    }

    /**
     * @param  GetTransactionsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetTransactionResponse => GetTransactionResponse::from($item), $attributes['data']),
            LinksResponse::from($attributes['links']),
            MetaResponse::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetTransactionResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
