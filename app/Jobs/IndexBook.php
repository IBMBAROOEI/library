<?php

namespace App\Jobs;

use App\Models\Book;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexBook implements ShouldQueue
{
    use Queueable,InteractsWithQueue,Queueable,SerializesModels;



    public function __construct(private Book $book,private Client $client)
    {
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

$this->client->index($param);
            \Log::error("su to index book{$this->book->id}" );

}catch(\Exception $e){
    \Log::error("faild to index book{$this->book->id}".$e->getMessage());
    $this->release(5);
}
    }
}
