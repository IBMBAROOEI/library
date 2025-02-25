<?php

namespace App\Action\Book;

use Illuminate\Support\Facades\Cache;
use App\Models\Book;

class ListBook {
    public function handel() {


        // return Cache::remember('books', 3600, function () {
        //     return Book::all();
        // }); // Make sure this line returns a collection

    }
  }



//   <?php

// namespace App\Action\Book;

// use Illuminate\Support\Facades\Cache; // این خط دیگر نیازی نیست
// use Illuminate\Support\Facades\Redis; // برای دسترسی به Redis
// use App\Models\Book;

// class ListBook {

//     public function handel() {
//         // بررسی وجود کلید در Redis
//         if (Redis::exists('all_books')) { // بررسی وجود کلید
//             // دریافت داده‌ها از Redis و دیکود کردن آنها
//             $book = json_decode(Redis::get('all_books'));
//             return collect( $book);
//         } else {
//             // دریافت همه کتاب‌ها از پایگاه داده
//             $book = Book::all();

//             // سریالیزه کردن کتاب‌ها به JSON و ذخیره در Redis با مدت زمان 120 ثانیه
//             Redis::setex('all_books', 120, $book->toJson()); // ذخیره به مدت 120 ثانیه

//             return $book;
//         }
//     }
//}
