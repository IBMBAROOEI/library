<?php


 namespace App\Action\Book;
 use App\Action\Data\BookData;
use App\Models\Book;



class updateCategories{


     public function handel(Book $book,BookData $bookData):Book{

  $book->update($bookData->toArray());
   return $book;


     }
}
