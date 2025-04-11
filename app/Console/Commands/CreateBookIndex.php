<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class CreateBookIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-book-index';



    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $client=ClientBuilder::create()->build();






         $indexparam=[
'index'=>'books',

'body'=>[



                'mappings' => [

                    'properties' => [
                        'title' => [
                            'type' => 'text',
                            'analyzer' => 'standard'
                        ],


                    ]
                ]


]

         ];




         try{

         $response=$client->indices()->create($indexparam);

         }catch(\Exception $e){
            $this->error('faild create index'.$e->getMessage());
         }

    }
}
