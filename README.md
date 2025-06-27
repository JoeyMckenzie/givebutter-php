<div align="center" style="padding-top: 2rem;">
    <img src="art/logo.png" height="300" width="300" alt="logo"/>
    <div style="display: inline-block; margin-top: 2rem">
        <img src="https://img.shields.io/packagist/v/joeymckenzie/givebutter-php.svg" alt="packgist downloads" />
        <img src="https://img.shields.io/github/actions/workflow/status/joeymckenzie/givebutter-php/run-ci.yml?branch=main&label=ci" alt="ci" />
        <img src="https://img.shields.io/github/actions/workflow/status/joeymckenzie/givebutter-php/fix-php-code-style-issues.yml?branch=main&label=code%20style" alt="packgist downloads" />
        <img src="https://img.shields.io/packagist/dt/joeymckenzie/givebutter-php.svg" alt="packgist downloads" />
        <img src="https://codecov.io/gh/JoeyMckenzie/givebutter-php/graph/badge.svg?token=AXMP8ZTMKD&style=flat-square" alt="codecov coverage report"/> 
    </div>
</div>

# 🧈 Givebutter PHP

Givebutter PHP is a plug 'n play and easy to use client for Givebutter's public API.

## Table of Contents

- [Getting started](#getting-started)
- [Usage](#usage)
    - [Campaigns](#campaigns)

## Getting started

The client is available as a composer packager that can be installed in any project using composer:

```bash
composer require joeymckenzie/givebutter-php
```

Since the client is compatible with any PSR-18 HTTP client, any commonly used HTTP client can be used thanks
to our dependency on `php-http/discovery`. Once both dependencies have been installed, you may start interacting
with [Givebutter's API](https://docs.givebutter.com/reference/reference-getting-started/):

```php
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
        'type' => 'collect',
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

```

For a comprehensive set of examples, take a look at the [examples](/examples) directory.

## Usage

### Campaigns

#### Create a campaign

Creates a campaign from a specified payload.

```php
$response = $client->campaigns()->create([
              'title' => 'Campaign title',
              'description' => 'Campaign description.',
              'end_at' => CarbonImmutable::now()->toIso8601String(),
              'goal' => 10000,
              'subtitle' => 'Campaign subtitle',
              'slug' => 'campaignSlug123',
              'type' => 'collect',
          ]);

echo $response->data(); // GetCampaignResponse::class
echo $response->id; // 42
echo $response->title; // 'Campaign title'
echo $response->goal; // 10000
echo $response->toArray(); // ['id' => 42, ...]
```

#### Get all campaigns

Gets a list of available campaigns. Optionally, accepts a scope parameter.

```php
$response = $client->campaigns()->list();

echo $response->data; // array<int, GetCampaignResponse::class>
echo $response->meta; // Meta::class
echo $response->links; // Links::class
echo $response->toArray(); // ['data' => ['id' => 42, ...], 'meta' => [...], 'links' => [...]]
```

#### Get a campaign

Gets a single campaign.

```php
$response = $client->campaigns()->get(42);

echo $response->data(); // GetCampaignResponse::class
echo $response->id; // 42
echo $response->title; // 'Campaign title'
echo $response->goal; // 10000
echo $response->toArray(); // ['id' => 42, ...]
```

#### Update a campaign

Updates a campaign from a specified payload.

```php
$response = $client->campaigns()->update(42, [
              'description' => 'Updated campaign description.',
              'goal' => 20000,
          ]);

echo $response->data(); // GetCampaignResponse::class
echo $response->id; // 42
echo $response->title; // 'Campaign title'
echo $response->goal; // 20000
echo $response->toArray(); // ['id' => 42, ...]
```

#### Delete a campaign

Deletes a campaign.

```php
$response = $client->campaigns()->delete(42);

echo $response->getStatusCode(); // 200
```