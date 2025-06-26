<?php

declare(strict_types=1);

use Givebutter\Client;
use Givebutter\Contracts\Resources\CampaignMembersResourceContract;
use Givebutter\Contracts\Resources\CampaignsResourceContract;
use Givebutter\Contracts\Resources\CampaignTeamsResourceContract;
use Givebutter\Contracts\Resources\ContactsResourceContract;
use Givebutter\Contracts\Resources\FundsResourceContract;
use Givebutter\Contracts\Resources\PayoutsResourceContract;
use Givebutter\Contracts\Resources\PlansResourceContract;
use Givebutter\Contracts\Resources\TicketsResourceContract;
use Givebutter\Contracts\Resources\TransactionsResourceContract;
use Givebutter\Resources\CampaignMembersResource;
use Givebutter\Resources\CampaignsResource;
use Givebutter\Resources\CampaignTeamsResource;
use Givebutter\Resources\ContactsResource;
use Givebutter\Resources\FundsResource;
use Givebutter\Resources\PayoutsResource;
use Givebutter\Resources\PlansResource;
use Givebutter\Resources\TicketsResource;
use Givebutter\Resources\TransactionsResource;
use Wrapkit\Contracts\ConnectorContract;

covers(Client::class);
covers(CampaignsResource::class);
covers(CampaignMembersResource::class);
covers(CampaignTeamsResource::class);
covers(ContactsResource::class);
covers(FundsResource::class);
covers(PayoutsResource::class);
covers(PlansResource::class);
covers(TicketsResource::class);
covers(TransactionsResource::class);

describe('Client', function (): void {
    beforeEach(function (): void {
        $this->connector = Mockery::mock(ConnectorContract::class);
        $this->client = new Client($this->connector);
    });

    it('can be instantiated with a connector', function (): void {
        // Assert
        expect($this->client)
            ->toBeInstanceOf(Client::class)
            ->connector->toBe($this->connector);
    });

    it('provides access to the campaigns resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->campaigns();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(CampaignsResourceContract::class)
            ->toBeInstanceOf(CampaignsResource::class);
    });

    it('provides access to the campaign members resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client
            ->campaigns()
            ->members();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(CampaignMembersResourceContract::class)
            ->toBeInstanceOf(CampaignMembersResource::class);
    });

    it('provides access to the campaign teams resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client
            ->campaigns()
            ->teams();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(CampaignTeamsResourceContract::class)
            ->toBeInstanceOf(CampaignTeamsResource::class);
    });

    it('provides access to the contacts resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->contacts();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(ContactsResourceContract::class)
            ->toBeInstanceOf(ContactsResource::class);
    });

    it('provides access to the funds resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->funds();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(FundsResourceContract::class)
            ->toBeInstanceOf(FundsResource::class);
    });

    it('provides access to the payouts resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->payouts();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(PayoutsResourceContract::class)
            ->toBeInstanceOf(PayoutsResource::class);
    });

    it('provides access to the plans resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->plans();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(PlansResourceContract::class)
            ->toBeInstanceOf(PlansResource::class);
    });

    it('provides access to the tickets resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->tickets();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(TicketsResourceContract::class)
            ->toBeInstanceOf(TicketsResource::class);
    });

    it('provides access to the transactions resource', function (): void {
        // Arrange & Act
        $serversResource = $this->client->transactions();

        // Assert
        expect($serversResource)
            ->toBeInstanceOf(TransactionsResourceContract::class)
            ->toBeInstanceOf(TransactionsResource::class);
    });

    it('provides a consistent resource instances with the same connector', function (): void {
        // Arrange & Act
        $resource1 = $this->client->campaigns();
        $resource2 = $this->client->campaigns();

        // Assert
        expect($resource1)->connector->toBe($this->connector);
        expect($resource2)
            ->connector->toBe($this->connector)
            ->and($resource1)->not->toBe($resource2);
    });

    it('has the correct API base URL defined', function (): void {
        // Arrange & Act & Assert
        expect(Client::API_BASE_URL)
            ->toBe('https://api.givebutter.com/v1');
    });
});
