<?php



 namespace App\Action\Book;


 use App\Models\Book;

 class DeleteBook{



     public function handel(int $id): void{

$book=Book::findOrFail($id);
$book->delete();
     }
 }