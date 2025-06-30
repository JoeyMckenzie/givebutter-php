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
use Givebutter\Testing\Resources\PayoutsTestResource;
use Givebutter\Testing\Resources\TicketsTestResource;
use Givebutter\Testing\Resources\TransactionsTestResource;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;
use Wrapkit\Contracts\ResponseContract;
use Wrapkit\Testing\ClientProxyFake;

final class ClientFake implements ClientContract
{
    public ClientProxyFake $proxy;

    /**
     * @template TResponse of ResponseContract<array<array-key, mixed>>
     *
     * @param  array<int, TResponse|ResponseInterface|Throwable>  $responses
     */
    public function __construct(array $responses = [])
    {
        $this->proxy = new ClientProxyFake($responses);
    }

    public function campaigns(): CampaignsResourceContract
    {
        return new CampaignsTestResource($this->proxy);
    }

    public function contacts(): ContactsResourceContract
    {
        return new ContactsTestResource($this->proxy);
    }

    public function tickets(): TicketsResourceContract
    {
        return new TicketsTestResource($this->proxy);
    }

    public function transactions(): TransactionsResourceContract
    {
        return new TransactionsTestResource($this->proxy);
    }

    public function payouts(): PayoutsResourceContract
    {
        return new PayoutsTestResource($this->proxy);
    }

    public function plans(): PlansResourceContract
    {
        throw new RuntimeException('Not implemented');
    }

    public function funds(): FundsResourceContract
    {
        throw new RuntimeException('Not implemented');
    }
}
