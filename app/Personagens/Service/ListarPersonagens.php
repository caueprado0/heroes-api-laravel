<?php

namespace Heroes\Personagens\Service;

use Heroes\RequisicaoHttp\Service\Requisicao;
use Heroes\Common\MarvelApiRequestTrait;

class ListarPersonagens
{
    use MarvelApiRequestTrait;

    const URL = "https://gateway.marvel.com/v1/public/characters";

    public function get():array
    {
        $requisicao = new Requisicao();
        $response = $requisicao->envia($this->getUrl(self::URL));

        if (substr($response->status, 0, 1) == '2') {
            return $response->corpo['data'];
        }

        return [];
    }
}
