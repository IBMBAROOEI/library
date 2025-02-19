<?php



namespace App\Action\Book;

use App\Models\Book;


class GetBook{



 public function handel(int $id):Book{



     return Book::findOrFail($id);
 }
}