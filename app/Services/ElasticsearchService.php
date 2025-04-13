<?php

namespace App\Services;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchService
{
    public Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function indexExists(string $indexName)
    {
        return $this->client->indices()->exists(['index' => $indexName]);
    }
}
