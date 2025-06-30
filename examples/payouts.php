<?php

declare(strict_types=1);

use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

// Get all payouts
$payouts = $client
    ->payouts()
    ->list();
var_dump($payouts);

if (count($payouts->data) > 0) {
    // Get a payout
    $payout = $client
        ->tickets()
        ->get($payouts->data[0]->id);
    var_dump($payout);
}
