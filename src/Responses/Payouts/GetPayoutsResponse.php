<?php

declare(strict_types=1);

namespace Givebutter\Responses\Payouts;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetPayoutResponseSchema from GetPayoutResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetPayoutsResponseSchema array{
 *     data: GetPayoutResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
 * }
 *
 * @implements ResponseContract<GetPayoutsResponseSchema>
 */
final readonly class GetPayoutsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetPayoutsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetPayoutsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetPayoutResponse[]  $data
     */
    public function __construct(
        public array $data,
        public Links $links,
        public Meta $meta,
    ) {
        //
    }

    /**
     * @param  GetPayoutsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetPayoutResponse => GetPayoutResponse::from($item), $attributes['data']),
            Links::from($attributes['links']),
            Meta::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetPayoutResponse $item): array => $item->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
