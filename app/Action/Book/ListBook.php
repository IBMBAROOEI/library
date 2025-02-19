<?php


 namespace App\Action\Book;


 use App\Models\Book;

  class ListBook{



    public function handel()                   {
            return Book::all();
    }
  }