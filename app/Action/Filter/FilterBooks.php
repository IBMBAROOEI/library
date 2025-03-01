<?php

namespace App\Action\Filter;

use App\Models\Book;
use Illuminate\Contracts\Database\Eloquent\Builder;

class FilterBooks
{


    public function handle(array $filter):Builder
    {

        $query = Book::query();


        if(!empty($filter['title'])){

 dd($query->where('title','like','%'.$filter['title'].'%')->toSql());



        }


        if (!empty($filter['author'])) {

            $query->where('author', 'like', '%'. $filter['author'] . '%');
        }


        if (isset($filter['price_min']) && isset($filter['price_max'])) {


            $query->whereBetween('price',[$filter['price_min'], $filter['price_min']]);
        }
        elseif

        (isset($filter['price_max'])) {

            $query->where('price','>=',[$filter['price_max']]);


        } elseif (isset($filter['price_min'])) {

            $query->where('price', '<=', [$filter['price_min']]);
        }


        return $query;

    }
}
