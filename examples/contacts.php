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

// Create a contact
$createdContact = $client
    ->contacts()
    ->create([
        'first_name' => 'Michael',
        'middle_name' => 'Gary',
        'last_name' => 'Scott',
        'email' => [
            [
                'type' => 'work',
                'value' => 'michael.scott@dundermifflin.com',
            ],
        ],
        'phones' => [
            [
                'type' => 'work',
                'value' => '+15303567734',
            ],
        ],
        'addresses' => [
            [
                'address_1' => '123 Paper St.',
                'city' => 'Scranton',
                'state' => 'PA',
                'zipcode' => '18507',
                'country' => 'US',
            ],
        ],
        'tags' => [
            'paper',
            'dunder mifflin',
        ],
        'dob' => '03/15/1965',
        'company' => 'Dunder Mifflin',
        'title' => 'Regional Manager',
        'twitter_url' => 'https://twitter.com/dundermifflin',
        'linkedin_url' => 'https://linkedin.com/in/dundermifflin',
        'facebook_url' => 'https://facebook.com/dundermifflin',
    ]);
var_dump($createdContact);
