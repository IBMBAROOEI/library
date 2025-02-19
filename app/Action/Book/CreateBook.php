<?php

namespace App\Action\Book;

use App\Action\Data\BookData;
use App\Models\Book;

class createBook
{
    public function handle(BookData $bookData): Book
    {
        return Book::create($bookData->toArray());
    }
}