<?php

namespace App\Action\Categories;

use Illuminate\Support\Facades\Cache;
use App\Models\Categorie;

class ListCategories {
    public function handel() {

$cate=Cache::remember('Categories',180,function(){
 return Categorie::all();
});
     return $cate;
  }

}
