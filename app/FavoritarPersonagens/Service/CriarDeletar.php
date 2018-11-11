<?php

namespace Heroes\FavoritarPersonagens\Service;

use Heroes\Personagens\Service\ListarPersonagens;
use Heroes\FavoritarPersonagens\Model\Favorito;
use Heroes\FavoritarPersonagens\Service\Listar;

class CriarDeletar
{
    public function __construct(Listar $listar, ListarPersonagens $listarPersonagens)
    {
        $this->listar = $listar;
        $this->listarPersonagens = $listarPersonagens;
    }

    public function create($id) : array
    {
        $resultado = $this->listarPersonagens->find($id);

        if (isset($resultado['results'])) {
            \Log::info("[HEROES][FAVORITOS][CREATE] Encontrado o ID: {$id}");
            $resultado['results'][0]['personagemId'] = $resultado['results'][0]['id'];
            unset($resultado['results'][0]['id']);

            if (Favorito::where('personagemId', $id)->first()) {
                $created = Favorito::where('personagemId', $id)->update($resultado['results'][0]);
                \Log::info("[HEROES][FAVORITOS][CREATE] Atualizado o ID: {$id} na collection favoritos.");
            } else {
                $created = Favorito::create($resultado['results'][0]);
                \Log::info("[HEROES][FAVORITOS][CREATE] Criado o ID: {$id} na collection favoritos.");
            }

            return $created->toArray();
        }
        throw new \Exception("O retorno da API da marvel nãou trouxe a chave results, causando um erro Inesperado.");
    }

    public function delete($id) : bool
    {
        $registro = $this->listar->find($id);
        $resultado = $registro->delete();

        return $resultado == true? true:false;
    }
}
