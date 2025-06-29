<?php

declare(strict_types=1);

namespace Givebutter\Responses\Contacts;

use Givebutter\Responses\Models\Links;
use Givebutter\Responses\Models\Meta;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Responses\Concerns\ArrayAccessible;
use Wrapkit\Testing\Concerns\Fakeable;

/**
 * @phpstan-import-type GetContactResponseSchema from GetContactResponse
 * @phpstan-import-type MetaSchema from Meta
 * @phpstan-import-type LinksSchema from Links
 *
 * @phpstan-type GetContactsResponseSchema array{
 *     data: GetContactResponseSchema[],
 *     links: LinksSchema,
 *     meta: MetaSchema
 * }
 *
 * @implements ResponseContract<GetContactsResponseSchema>
 */
final readonly class GetContactsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<GetContactsResponseSchema>
     */
    use ArrayAccessible;

    /**
     * @use Fakeable<GetContactsResponseSchema>
     */
    use Fakeable;

    /**
     * @param  GetContactResponse[]  $data
     */
    public function __construct(
        public array $data,
        public Links $links,
        public Meta $meta,
    ) {
        //
    }

    /**
     * @param  GetContactsResponseSchema  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $item): GetContactResponse => GetContactResponse::from($item), $attributes['data']), // @pest-mutate-ignore
            Links::from($attributes['links']),
            Meta::from($attributes['meta']),
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(static fn (GetContactResponse $contact): array => $contact->toArray(), $this->data), // @pest-mutate-ignore
            'links' => $this->links->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
