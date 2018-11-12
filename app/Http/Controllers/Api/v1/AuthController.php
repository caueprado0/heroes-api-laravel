<?php

namespace Heroes\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Heroes\Usuario\Model\Usuario;
use Heroes\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|string|email|unique:usuarios',
            'password' => 'required|string|confirmed'
        ]);

        $user = new Usuario([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 201,
            "sucesso" => true,
            "mensagem" => "Sucesso, Usuário Criado com Sucesso!",
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 401,
                "sucesso" => false,
                "mensagem" => "Credenciais inválidas.",
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 200,
            "sucesso" => true,
            "mensagem" => "Sucesso, utilize a chave data para obter seus dados de retorno.",
            "data" => [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            "url" => $request->fullUrl(),
            "statusCode" => 200,
            "sucesso" => true,
            "mensagem" => "Logout efetuado com sucesso.",
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
