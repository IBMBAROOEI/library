<?php

namespace App\Jobs;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IndexBook implements ShouldQueue
{
    use Queueable,InteractsWithQueue,Queueable,SerializesModels;



    public function __construct(protected $book)
    {
         $this->book=$book;
    }


    public function handle(): void
    {


$client=ClientBuilder::create()->build();

$param=[

    'index'=>'books',
    'id'=>$this->book->id,
    'body'=>[
       'title'=>$this->book->title

    ],
];

try{



}catch(\Exception $e){
    \Log::error('faild to index book'.$e->getMessage());
    $this->release(5);
}
    }
}
