<?php

declare(strict_types=1);

namespace Givebutter\Testing\Fixtures\Tickets;

use Carbon\CarbonImmutable;
use Givebutter\Responses\Tickets\GetTicketResponse;
use Givebutter\Testing\Fixtures\Concerns\HasErrorData;
use Wrapkit\Testing\AbstractDataFixture;

/**
 * @phpstan-import-type GetTicketResponseSchema from GetTicketResponse
 */
final class GetTicketFixture extends AbstractDataFixture
{
    use HasErrorData;

    public static function data(): array
    {
        /** @var GetTicketResponseSchema $data */
        $data = [
            'id' => 'ticket_12345',
            'id_suffix' => 'T12345',
            'name' => 'VIP Access',
            'first_name' => 'Michael',
            'last_name' => 'Johnson',
            'email' => 'michael.johnson@example.com',
            'phone' => '555-555-5555',
            'title' => 'Annual Gala VIP Ticket',
            'description' => 'VIP access to the annual fundraising gala',
            'price' => 75,
            'pdf' => 'https://example.com/tickets/ticket_12345.pdf',
            'arrived_at' => CarbonImmutable::now()->toIso8601String(),
            'created_at' => CarbonImmutable::now()->toIso8601String(),
        ];

        return $data;
    }
}
