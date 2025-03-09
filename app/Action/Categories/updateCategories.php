<?php


 namespace App\Action\Categories;
use App\Action\Data\CategoriesData;
use App\Models\Categorie;

class updateCategories{


     public function handel(Categorie $categorie,CategoriesData $categoriesData):Categorie{

        $categorie->update($categoriesData->toArray());
          return $categorie;


     }
}
