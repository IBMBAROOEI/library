<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\Client;
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



    public function __construct(private Client $client)
    {

        parent::__construct();
    }


    public function handle()
    {


        $indexparam = [
            'index' => 'books',

            'body' => [



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


        try {

            $response = $this->client->indices()->create($indexparam);
            $this->info('index create su'.$response);
        } catch (\Exception $e) {
            $this->error('faild create index' . $e->getMessage());
        }
    }
}
