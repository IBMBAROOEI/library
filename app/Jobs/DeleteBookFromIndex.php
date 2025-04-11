<?php

namespace App\Jobs;

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
    public function __construct(protected $bookid)
    {
        $this->bookid=$bookid;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = ClientBuilder::create()->build();

    $param=[

     'index'=>'books',
     'id'=>$this->bookid,

    ];

    try{

    }catch(\Exception $e){
        \Log::error('faild job delete book'. $e->getMessage());
        $this->release(5);
    }

    }
}
