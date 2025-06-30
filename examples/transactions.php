<?php

declare(strict_types=1);

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
    // Get a transaction
    $transaction = $client
        ->transactions()
        ->get($transactions->data[0]->id);
    var_dump($transaction);
}
