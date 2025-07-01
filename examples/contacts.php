<?php

declare(strict_types=1);

use Givebutter\Givebutter;

use function Pest\Faker\fake;

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
        'first_name' => fake()->firstName(),
        'middle_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => [
            [
                'type' => 'work',
                'value' => fake()->email(),
            ],
        ],
        'phones' => [
            [
                'type' => 'work',
                'value' => fake()->e164PhoneNumber(),
            ],
        ],
        'addresses' => [
            [
                'address_1' => fake()->streetAddress(),
                'city' => fake()->city(),
                'state' => 'CA',
                'zipcode' => fake()->postcode(),
                'country' => 'US',
            ],
        ],
        'tags' => [
            fake()->word(),
            fake()->word(),
        ],
        'dob' => fake()->dateTimeBetween('-90 years', '-25 years')->format('m/d/Y'),
        'company' => fake()->company(),
        'title' => fake()->title(),
        'twitter_url' => fake()->url(),
        'linkedin_url' => fake()->url(),
        'facebook_url' => fake()->url(),
    ]);
var_dump($createdContact);

if (! $createdContact->hasErrors()) {
    assert($createdContact->id !== null);

    // Update a contact
    $updatedContact = $client
        ->contacts()
        ->update($createdContact->id, [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company' => fake()->company(),
            'title' => fake()->title(),
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
