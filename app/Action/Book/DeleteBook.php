<?php



 namespace App\Action\Book;


 use App\Models\Book;

 class DeleteBook{



     public function handel(Book $book): void{


$book->delete();
     }
 }