<?php

declare(strict_types=1);

namespace Givebutter;

use Givebutter\Contracts\ClientContract;
use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Givebutter\Resources\CampaignsResource;
use Givebutter\Resources\ContactsResource;
use Givebutter\Resources\FundsResource;
use Givebutter\Resources\PayoutsResource;
use Givebutter\Resources\PlansResource;
use Givebutter\Resources\TicketsResource;
use Givebutter\Resources\TransactionsResource;
use Wrapkit\Contracts\ConnectorContract;

final readonly class Client implements ClientContract
{
    public const string API_BASE_URL = 'https://api.givebutter.com/v1';

    public function __construct(
        public ConnectorContract $connector
    ) {
        //
    }

    public function campaigns(): CampaignsResourceContract
    {
        return new CampaignsResource($this->connector);
    }

    public function contacts(): ContactsResourceContract
    {
        return new ContactsResource($this->connector);
    }

    public function tickets(): TicketsResourceContract
    {
        return new TicketsResource($this->connector);
    }

    public function transactions(): TransactionsResourceContract
    {
        return new TransactionsResource($this->connector);
    }

    public function payouts(): PayoutsResourceContract
    {
        return new PayoutsResource($this->connector);
    }

    public function plans(): PlansResourceContract
    {
        return new PlansResource($this->connector);
    }

    public function funds(): FundsResourceContract
    {
        return new FundsResource($this->connector);
    }
}
