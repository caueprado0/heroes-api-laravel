<?php

namespace Heroes\FavoritarPersonagens\Service;

use Heroes\FavoritarPersonagens\Model\Favorito;

class Listar
{
    public function all()
    {
        return Favorito::all();
    }

    public function find($id)
    {
        return Favorito::findOrFail($id);
    }
}
