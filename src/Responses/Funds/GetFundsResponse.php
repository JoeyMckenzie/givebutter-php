<?php

declare(strict_types=1);

namespace Givebutter\Responses\Funds;

use Givebutter\Responses\Concerns\Fallible;
use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type LinksSchema from Links
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type GetFundResponseSchema from GetFundResponse
 *
 * @phpstan-type GetFundsResponseSchema array{
 *     data: GetFundResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
 * }
 *
 * @implements ResponseContract<GetFundsResponseSchema>
 */
final readonly class GetFundsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetFundsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetFundsResponseSchema>
     */
    use Fakeable;

    use Fallible;

    /**
     * @param  GetFundResponse[]  $data
     */
    private function __construct(
        public array $data,
        public Links $links,
        public Meta $meta,
    ) {
        //
    }

    /**
     * @param  GetFundsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetFundResponse => GetFundResponse::from($item), $attributes['data']),
            Links::from($attributes['links']),
            Meta::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetFundResponse $response): array => $response->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
