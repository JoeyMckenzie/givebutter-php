<?php

declare(strict_types=1);

namespace Givebutter\Contracts;

use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Contracts\Resources\TransactionsResourceContract;

interface ClientContract
{
    public function campaigns(): CampaignsResourceContract;

    public function contacts(): ContactsResourceContract;

    public function tickets(): TicketsResourceContract;

    public function transactions(): TransactionsResourceContract;

    public function payouts(): PayoutsResourceContract;

    public function plans(): PlansResourceContract;

    public function funds(): FundsResourceContract;
}
