<?php

namespace App\Jobs;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteBookFromIndex implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $bookid ,private Client $client)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

    $param=[

     'index'=>'books',
     'id'=>$this->bookid,

    ];

    try{

$this->client->delete($param);
            \Log::error("book with id job delete book.{$this->bookid}");
        }catch(\Exception $e){
        \Log::error('faild job delete book'. $e->getMessage());
        $this->release(5);
    }

    }
}
