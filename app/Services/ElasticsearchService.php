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



    public function index(array $params)
    {
        try {
            $response = $this->client->index($params);
            return $response; // بازگرداندن پاسخ Elasticsearch برای بررسی
        } catch (\Exception $e) {
            throw new \Exception("Elasticsearch indexing failed: " . $e->getMessage());
        }
    }

    public function indexExists(string $indexName)
    {
        return $this->client->indices()->exists(['index' => $indexName]);
    }
}
