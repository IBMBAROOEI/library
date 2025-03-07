<?php

namespace App\Action\Book;

 use App\Model\Categorie;
class createCategorie
{
    public function handle(Categorie $categorie): Book
    {
 $data=$categorie->toArray();

        return Categorie::create($data);
    }
}
