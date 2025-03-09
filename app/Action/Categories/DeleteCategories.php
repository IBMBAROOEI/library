<?php

 namespace App\Action\Categories;

use App\Models\Categorie;

 class DeleteCategories{



 public function handel(Categorie $Categorie): void{


        $Categorie->delete();
     }
 }
