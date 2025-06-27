<?php

declare(strict_types=1);

namespace Givebutter;

use Givebutter\Contracts\ClientContract;
use Givebutter\Resources\Concerns\HasCampaigns;
use Givebutter\Resources\Concerns\HasContacts;
use Givebutter\Resources\Concerns\HasFunds;
use Givebutter\Resources\Concerns\HasPayouts;
use Givebutter\Resources\Concerns\HasPlans;
use Givebutter\Resources\Concerns\HasTickets;
use Givebutter\Resources\Concerns\HasTransactions;
use Wrapkit\Contracts\ConnectorContract;

final readonly class Client implements ClientContract
{
    use HasCampaigns,
        HasContacts,
        HasFunds,
        HasPayouts,
        HasPlans,
        HasTickets,
        HasTransactions;

    public const string API_BASE_URL = 'https://api.givebutter.com/v1';

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }
}
