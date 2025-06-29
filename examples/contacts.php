<?php

declare(strict_types=1);

use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

// Get a contact
$contact = $client
    ->contacts()
    ->get(24837053);
var_dump($contact);

// Get all contacts
$contacts = $client
    ->contacts()
    ->list();
var_dump($contacts);
