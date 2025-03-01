<?php

namespace App\Models;

use App\BookStatus;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [


      'title',
        'author',
        'description',
        'stock_quantity',
        'language',
        'parent_id',
        'page_count',
        'related_books',
        'cover_image',
        'type',
        'price',
        'published_at',
    ];



Public function childern(){
    return $this->hasMany(Book::class,'parent_id');
}

    protected $casts = [

        'type'=>BookStatus::class,
        'published_at'=>'date',
    ];



public function parent(){

     return $this->belongsTo(Book::class,'parent_id');
}


}
