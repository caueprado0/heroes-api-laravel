<?php

namespace Heroes\FavoritarPersonagens\Service;

use Heroes\FavoritarPersonagens\Service\CriarDeletar;
use Heroes\FavoritarPersonagens\Service\Listar;

class Favorito
{
    public function __construct(Listar $listar, CriarDeletar $criarDeletar)
    {
        $this->listar = $listar;
        $this->criarDeletar = $criarDeletar;
    }

    public function create($id)
    {
        return $this->criarDeletar->create($id);
    }

    public function delete($id)
    {
        return $this->criarDeletar->delete($id);
    }

    public function all()
    {
        return $this->listar->all();
    }

    public function find($id)
    {
        return $this->listar->find();
    }
}
