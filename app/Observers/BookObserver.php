<?php

namespace App\Observers;

use App\Jobs\DeleteBookFromIndex;
use App\Jobs\IndexBook;
use App\Models\Book;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        IndexBook::dispatch($book);
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
