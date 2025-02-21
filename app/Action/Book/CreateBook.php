<?php

namespace App\Action\Book;

use App\Action\Data\BookData;
use App\Models\Book;
use App\BookStatus;
class createBook
{
    public function handle(BookData $bookData): Book
    {
 $data=$bookData->toArray();

        // if (empty($data['type'])) {
        //     $data['type'] = BookStatus::Deactive->value;
        // }
        return Book::create($data);
    }
}