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
    ->get(123);
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
                'value' => 'michael.scott@dundermiffline',
            ],
        ],
        'phones' => [
            [
                'type' => 'work',
                'value' => '+15708675309',
            ],
        ],
        'addresses' => [
            [
                'address_1' => '123 Paper st.',
                'city' => 'Scranton',
                'state' => 'PA',
                'zipcode' => '18507',
                'country' => 'US',
            ],
        ],
        'tags' => [
            'paper',
        ],
        'dob' => '03/15/1967',
        'company' => 'Dunder Mifflin',
        'title' => 'Regional Manager',
        'twitter_url' => 'https://twitter.com/michaelscott',
        'linkedin_url' => 'https://linkedin.com/in/michaelscott',
        'facebook_url' => 'https://facebook.com/michaelscott',
    ]);
var_dump($createdContact);

if (! $createdContact->hasErrors()) {
    assert($createdContact->id !== null);

    // Update a contact
    $updatedContact = $client
        ->contacts()
        ->update($createdContact->id, [
            'first_name' => 'Michael',
            'last_name' => 'Scarn',
            'company' => 'CIA',
            'title' => 'Secret Agent',
        ]);
    var_dump($updatedContact);

    // Archive a contact
    $deletedContactResponse = $client
        ->contacts()
        ->archive($createdContact->id);
    var_dump($deletedContactResponse->getStatusCode());

    // Restore a contact
    $restoredContact = $client
        ->contacts()
        ->restore($createdContact->id);
    var_dump($restoredContact);
}
