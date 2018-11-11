<?php

namespace Heroes\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Heroes\Http\Controllers\Controller;
use Heroes\FavoritarPersonagens\Service\Favorito as FavoritoService;
use Heroes\FavoritarPersonagens\Service\Listar;

class Favorito extends Controller
{
    public function __construct(FavoritoService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $data = $this->service->create($request->input('personagemId'));
        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 200,
            "sucesso" => true,
            "mensagem" => "Sucesso, utilize a chave data para obter seus dados de retorno.",
            "data" => $data,
        ]);
    }

    public function delete(Request $request, $id)
    {
        $this->service->delete($id);
        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 204,
            "sucesso" => true,
            "mensagem" => "Sucesso, utilize a chave data para obter seus dados de retorno.",
            "data" => [],
        ], 204);
    }

    public function all(Request $request)
    {
        $query = is_array($request->query())? $request->query():[];

        $data = $this->service->getAll($query);
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
        $query = is_array($request->query())? $request->query():[];

        $data = $this->service->find($id, $query);
        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 200,
            "sucesso" => true,
            "mensagem" => "Sucesso, utilize a chave data para obter seus dados de retorno.",
            "data" => $data,
        ]);
    }
}
