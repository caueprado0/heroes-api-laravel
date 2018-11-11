<?php

namespace Heroes\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Heroes\Http\Controllers\Controller;
use Heroes\Personagens\Service\ListarPersonagens;

class Personagem extends Controller
{
    protected $service;
    public function __construct(ListarPersonagens $service)
    {
        $this->service = $service;
    }

    public function all(Request $request)
    {
        $data = $this->service->getAll();
        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 200,
            "sucesso" => true,
            "mensagem" => "Sucesso, utilize a chave data para obter seus dados de retorno.",
            "data" => $data,
        ]);
    }

    public function find(Request $request, $id)
    {
        $data = $this->service->find($id);
        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 200,
            "sucesso" => true,
            "mensagem" => "Sucesso, utilize a chave data para obter seus dados de retorno.",
            "data" => $data,
        ]);
    }
}
