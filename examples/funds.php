<?php

declare(strict_types=1);

use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

// Get all funds
$funds = $client
    ->funds()
    ->list();

if (count($funds->data) > 0 && $funds->data[0]->id !== null) {
    // Get a fund
    $fund = $client
        ->funds()
        ->get($funds->data[0]->id);
    var_dump($fund);
}
