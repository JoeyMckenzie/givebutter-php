<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Tickets;

use Givebutter\Responses\Tickets\GetTicketsResponse;
use Givebutter\Testing\Fixtures\Models\LinksFixture;
use Givebutter\Testing\Fixtures\Models\MetaFixture;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetTicketsResponseSchema from GetTicketsResponse
 */
final class GetTicketsFixture extends AbstractDataFixture
{
    public static function data(): array
    {
        /** @var GetTicketsResponseSchema $data */
        $data = [
            'data' => array_map(static fn (): array => GetTicketFixture::data(), range(1, 5)),
            'meta' => MetaFixture::data(),
            'links' => LinksFixture::data(),
        ];

        return $data;
    }
}
