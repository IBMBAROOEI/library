<?php

namespace App\Action\Book;

use App\Action\Data\CategoriesData;
use App\Models\Categorie as ModelsCategorie;

class createCategorie
{
    public function handle(CategoriesData $categorie): ModelsCategorie
    {
 $data=$categorie->toArray();

        return ModelsCategorie::create($data);
    }
}
