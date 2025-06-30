<?php

declare(strict_types=1);

namespace Givebutter\Responses\Transactions;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetTransactionResponseSchema from GetTransactionResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetTransactionsResponseSchema array{
 *     data: GetTransactionResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
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
        public Links $links,
        public Meta $meta,
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
            Links::from($attributes['links']),
            Meta::from($attributes['meta']),
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
