<?php

namespace App\Models;

use App\BookStatus;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "title","author","description","type","price",
        "published_at"
    ];


    protected $casts = [

        'type'=>BookStatus::class,
        'published_at'=>'date',
    ];


    

}
