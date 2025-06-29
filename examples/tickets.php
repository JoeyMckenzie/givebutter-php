<?php

declare(strict_types=1);

use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

// Get all tickets
$tickets = $client
    ->tickets()
    ->list();
var_dump($tickets);

if (count($tickets->data) > 0) {
    // Get a ticket
    $ticket = $client
        ->tickets()
        ->get($tickets->data[0]->id);
    var_dump($ticket);
}
