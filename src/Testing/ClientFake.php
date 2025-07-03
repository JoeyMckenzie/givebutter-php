<?php

declare(strict_types=1);

namespace Givebutter\Testing;

use Givebutter\Contracts\ClientContract;
use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Givebutter\Testing\Resources\CampaignsTestResource;
use Givebutter\Testing\Resources\ContactsTestResource;
use Givebutter\Testing\Resources\FundsTestResource;
use Givebutter\Testing\Resources\PayoutsTestResource;
use Givebutter\Testing\Resources\PlansTestResource;
use Givebutter\Testing\Resources\TicketsTestResource;
use Givebutter\Testing\Resources\TransactionsTestResource;
use Psr\Http\Message\ResponseInterface;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Testing\Concerns\AssertsRequests;

/**
 * @template TResponse of ResponseContract<array<array-key, mixed>>|ResponseInterface
 */
final class ClientFake implements ClientContract
{
    /**
     * @use AssertsRequests<TResponse>
     */
    use AssertsRequests;

    public function campaigns(): CampaignsResourceContract
    {
        return new CampaignsTestResource($this);
    }

    public function contacts(): ContactsResourceContract
    {
        return new ContactsTestResource($this);
    }

    public function tickets(): TicketsResourceContract
    {
        return new TicketsTestResource($this);
    }

    public function transactions(): TransactionsResourceContract
    {
        return new TransactionsTestResource($this);
    }

    public function payouts(): PayoutsResourceContract
    {
        return new PayoutsTestResource($this);
    }

    public function plans(): PlansResourceContract
    {
        return new PlansTestResource($this);
    }

    public function funds(): FundsResourceContract
    {
        return new FundsTestResource($this);
    }
}
