<?php

namespace App\Action\Book;

use Illuminate\Support\Facades\Cache;
use App\Models\Book;

class ListBook {
    public function handel() {

$book=Cache::remember('books',180,function(){
 return Book::all();
});


     return $book;
  }

}
