<?php

namespace Heroes\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 404,
                "sucesso" => false,
                "mensagem" => env('APP_ENV') == 'local'? $exception->getMessage():"URL não encontrada"
            ], 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 405,
                "sucesso" => false,
                "mensagem" => env('APP_ENV') == 'local'? $exception->getMessage():"Método não permitido."
            ], 405);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 404,
                "sucesso" => false,
                "mensagem" => env('APP_ENV') == 'local'? $exception->getMessage():"Recurso não encontrado. Tente passar um outro ID."
            ], 404);
        }

        if ($exception instanceof QueryException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 409,
                "sucesso" => false,
                "mensagem" => env('APP_ENV') == 'local'? $exception->getMessage():"A query informada estava incorreta."
            ], 409);
        }

        if ($exception instanceof MorphRelationChildrenException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 409,
                "sucesso" => false,
                "mensagem" => env('APP_ENV') == 'local'? $exception->getMessage():"Relação feita de forma incorreta."
            ], 409);
        }

        if ($exception instanceof MaintenanceModeException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 503,
                "sucesso" => false,
                "mensagem" => "A API está em manutenção, favor tentar novamente mais tarde ou entrar em contato com o TI."
            ], 503);
        }

        if ($exception instanceof ValidatorException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 422,
                "sucesso" => false,
                "mensagem" => "Os dados fornecidos são inválidos, por favor verificar a chave data com os detalhes.",
                "data" => $exception->errors(),
            ], 422);
        }
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 402,
                "sucesso" => false,
                "mensagem" => "Os dados fornecidos são inválidos, por favor verificar a chave data com os detalhes.",
                "data" => $exception->errors()
            ], 422);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                "url" => $request->fullUrl(),
                "statusCode" => 422,
                "sucesso" => false,
                "mensagem" => "Você não está autenticado. Para realizar essa operação é necessário estar autenticado.",
            ], 402);
        }

        return parent::render($request, $exception);
    }
}

