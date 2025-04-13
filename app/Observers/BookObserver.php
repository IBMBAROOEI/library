<?php

namespace App\Observers;

use App\Jobs\DeleteBookFromIndex;
use App\Jobs\IndexBook;
use App\Models\Book;
use App\Services\ElasticsearchService;
use PhpParser\JsonDecoder;

class BookObserver
{


       private ElasticsearchService $elasticsearchService;


        public function __construct(ElasticsearchService $elasticsearchService)
        {
 $this->elasticsearchService=$elasticsearchService;
        }
    public function created(Book $book): void
    {

        IndexBook::dispatch($book,$this->elasticsearchService);

    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        IndexBook::dispatch($book);
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        DeleteBookFromIndex::dispatch($book->id);
    }


}
