<?php


 namespace App\Action\Book;
 use App\Action\Data\BookData;
use App\Models\Book;



class UpdateBook{


     public function handel(int $id,BookData $bookData):Book{

 $book=Book::find($id);
 return  $book->update($bookData->toArray());


     }
}