<?php

namespace App\Action\Categories;

use App\Action\Data\CategoriesData;
use App\Models\Categorie ;

class CreateCategorie
{
    public function handle(CategoriesData $categorie): Categorie
    {
      $data=$categorie->toArray();

        return Categorie::create($data);

    }
}
