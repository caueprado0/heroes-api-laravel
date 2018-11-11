<?php

namespace Heroes\FavoritarPersonagens\Service;

use Heroes\FavoritarPersonagens\Model\Favorito;

class Listar
{
    public function all()
    {
        Favorito::updateOrCreate([]);
    }

    public function find($id)
    {
        return Favorito::findOrFail($id);
    }
}
