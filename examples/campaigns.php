<?php

declare(strict_types=1);

use Givebutter\Givebutter;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

/** @var string $apiKey */
$apiKey = $_ENV['GIVEBUTTER_API_KEY'];
$client = Givebutter::client($apiKey);

$campaign = $client
    ->campaigns()
    ->get(441507);
var_dump($campaign);

$campaigns = $client
    ->campaigns()
    ->list();
var_dump($campaigns);
