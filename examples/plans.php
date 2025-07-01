<?php

declare(strict_types=1);

use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

// Get all plans
$plans = $client
    ->plans()
    ->list();
var_dump($plans);

if (count($plans->data) > 0) {
    assert($plans->data[0]->id !== null);

    // Get a plan
    $plan = $client
        ->plans()
        ->get($plans->data[0]->id);
    var_dump($plan);
}
