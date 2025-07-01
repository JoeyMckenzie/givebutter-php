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

// Create a fund
$createdFund = $client
    ->funds()
    ->create("Scott's Tots");
var_dump($createdFund);

// Update a fund
$updatedFund = $client
    ->funds()
    ->update($createdFund->id ?? '', "Scott's Tots 2 Fast 2 Furious");
var_dump($updatedFund);

// Delete a fund
$client->funds()->delete($createdFund->id ?? '');
