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

// Create a campaign
$createdCampaign = $client
    ->campaigns()
    ->create([
        'description' => 'This is a test campaign.',
        'end_at' => CarbonImmutable::now()->toIso8601String(),
        'goal' => 1000,
        'subtitle' => 'subtitle',
        'slug' => md5(uniqid('', true)),
        'title' => 'title',
    ]);
var_dump($createdCampaign);

// Get a campaign
$campaign = $client
    ->campaigns()
    ->get(441507);
var_dump($campaign);

// Get all campaigns
$campaigns = $client
    ->campaigns()
    ->list();
var_dump($campaigns);

if (! $campaign->hasErrors()) {
    assert($campaign->id !== null);

    // Update a campaign
    $updatedCampaign = $client
        ->campaigns()
        ->update($campaign->id, [
            'description' => 'This is a test campaign.',
            'goal' => 1500,
        ]);
    var_dump($updatedCampaign);

    // Delete a campaign
    $deleteResponse = $client
        ->campaigns()
        ->delete($campaign->id);
    var_dump($deleteResponse);
}
