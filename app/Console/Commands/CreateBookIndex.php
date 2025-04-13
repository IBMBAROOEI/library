<?php

namespace App\Console\Commands;

use App\Services\ElasticsearchService;
use Illuminate\Console\Command;

class CreateBookIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-book-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Elasticsearch index for books';

    public function __construct(private ElasticsearchService $elasticsearchService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $indexName = 'books';

        // بررسی وجود ایندکس
        if ($this->elasticsearchService->indexExists($indexName)) {
            $this->info("Index '$indexName' already exists.");
            return;
        }

        $indexParams = [
            'index' => $indexName,
            'body' => [
                'mappings' => [
                    'properties' => [
                        'title' => [
                            'type' => 'text',
                            'analyzer' => 'standard',
                        ],
                        // می‌توانی فیلدهای بیشتری اضافه کنی
                    ],
                ],
            ],
        ];

        try {
            $response = $this->elasticsearchService->getClient()->indices()->create($indexParams);
            $this->info('Index created successfully: ' . json_encode($response));
        } catch (\Exception $e) {
            $this->error('Failed to create index: ' . $e->getMessage());
        }
    }
}
