<?php

namespace App\Jobs;

use App\Models\Book;
use App\Services\ElasticsearchService;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexBook implements ShouldQueue
{
    use Queueable,InteractsWithQueue,Queueable,SerializesModels;


 private Book $book;
 private ElasticsearchService $elasticsearchService;

    public function __construct(Book $book ,ElasticsearchService $elasticsearchService)
    {

        $this->book=$book;

        $this->elasticsearchService=$elasticsearchService;
    }


    public function handle(): void
    {



        $param=[

    'index'=>'books',
    'id'=>$this->book->id,
    'body'=>[
       'title'=>$this->book->title

    ],
];

try{

$this->elasticsearchService->index($param);
            \Log::error("su to index book{$this->book->id}" );

}catch(\Exception $e){
    \Log::error("faild to index book{$this->book->id}".$e->getMessage());
    $this->release(5);
}
    }
}
