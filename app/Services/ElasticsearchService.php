<?php


namespace App\Services;




use Elastic\Elasticsearch\Client;

use Elastic\Elasticsearch\ClientBuilder;


class ElasticsearchService{



    public function __construct(protected $client)
    {

$this->client=ClientBuilder::create()->build();
    }


    public function getClient():Client{

        return $this->client;
    }
}
