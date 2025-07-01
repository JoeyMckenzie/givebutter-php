<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

// Get all transactions
$transactions = $client
    ->transactions()
    ->list();
var_dump($transactions);

if (count($transactions->data) > 0) {
    assert($transactions->data[0]->id !== null);

    // Get a transaction
    $transaction = $client
        ->transactions()
        ->get($transactions->data[0]->id);
    var_dump($transaction);
}

// Create a transaction
$createdTransaction = $client
    ->transactions()
    ->create([
        'amount' => 100.00,
        'method' => 'cash',
        'transacted_at' => CarbonImmutable::now()->addHour()->format('m/d/y'),
        'campaign_code' => 'CMMNG1',
        'first_name' => 'Joey',
        'last_name' => 'McKenzie',
    ]);
var_dump($createdTransaction);
