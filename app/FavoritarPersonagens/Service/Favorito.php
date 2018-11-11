<?php

namespace Heroes\FavoritarPersonagens\Service;

use Heroes\Personagens\Service\ListarPersonagens;
use Heroes\FavoritarPersonagens\Model\Favorito;
use Heroes\FavoritarPersonagens\Service\Listar;

class Favorito
{
    public function __construct(Listar $listar, ListarPersonagens $listarPersonagens)
    {
        $this->listar = $listar;
        $this->listarPersonagens = $listarPersonagens;
    }

    public function set($id) : Favorito
    {
        $resultado = $this->listarPersonagens->find($id);

        if (isset($resultado['results'])) {
            $resultado['results']['personagemId'] = $resultado['results']['id'];
            unset($resultado['results']['id']);

            Favorito::updateOrCreate($resultado['results'], ['personagemId' => $id]);

            return $this->listar->find($id);
        }
        throw new \Exception("O retorno da API da marvel nãou trouxe a chave results, causando um erro Inesperado.");
    }

    protected function delete($id) : bool
    {
        $registro = $this->listar->find($id);
        $resultado = $registro->delete();

        return $resultado == true? true:false;
    }
}
