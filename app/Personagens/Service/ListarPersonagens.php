<?php

namespace Heroes\Personagens\Service;

use Heroes\RequisicaoHttp\Service\Requisicao;
use Heroes\Common\MarvelApiRequestTrait;

class ListarPersonagens
{
    use MarvelApiRequestTrait;

    const URL = "https://gateway.marvel.com/v1/public/characters";

    public function getAll($queryParam = []):array
    {
        $requisicao = new Requisicao();
        $response = $requisicao->envia($this->getUrl(self::URL, 1, $queryParam));

        if (substr($response->status, 0, 1) == '2') {
            return $response->corpo['data'];
        }

        return [];
    }

    public function find($id, $queryParam = []):array
    {
        $requisicao = new Requisicao();
        $response = $requisicao->envia($this->getUrl(self::URL."/{$id}", 1, $queryParam));

        if (substr($response->status, 0, 1) == '2') {
            return $response->corpo['data'];
        }

        return [];
    }
}
