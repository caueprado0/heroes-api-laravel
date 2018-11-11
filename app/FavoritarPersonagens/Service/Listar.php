<?php

namespace Heroes\FavoritarPersonagens\Service;

use Heroes\FavoritarPersonagens\Model\Favorito;

class Listar
{
    public function all($id) : Favorito
    {
        Favorito::updateOrCreate([]);
    }

    protected function find($id) : Favorito
    {
        return Favorito::findOrFail($id);
    }
}
