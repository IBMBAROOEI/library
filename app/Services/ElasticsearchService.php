<?php

namespace App\Services;




use Elastic\Elasticsearch\Client;


use Elastic\Elasticsearch\ClientBuilder;



class ElasticsearchService{

 public Client $client;



 public function __construct()
 {


$this->client=ClientBuilder::create()->build();
 }




public function getclient():client{

 return $this->client;

}

}
