<?php

Route::prefix('v1')->namespace('Api\\v1')->group(function () {
    Route::get('/', function () {
        $mensagem = "O projeto Heroes é um software aberto desenvolvido pelo Cauê Prado";
        $mensagem .= PHP_EOL . "Linkedin: https://www.linkedin.com/in/caueprado/";
        $mensagem .= PHP_EOL . "Instagram: @sigaocaue";
        $mensagem .= PHP_EOL . "Github: caueprado0";

        return response()->json([
            "url" =>"/",
            "sucesso" => true,
            "mensagem" => $mensagem
        ]);
    })->name('v1_index');

    //PERSONAGEM
    Route::prefix('personagem')->middleware('auth:api')->group(function () {
        Route::get('/', 'Personagem@all')
        ->name('v1_obter_personagens');

        Route::get('/{personagem}', 'Personagem@find')
        ->name('v1_obter_personagem');
    });

    //PERSONAGEM
    Route::prefix('favoritos')->middleware('auth:api')->group(function () {
        Route::post('/{personagemId}', 'Favorito@create')
        ->name('v1_criar_favoritos');

        Route::delete('/{personagemId}', 'Favorito@delete')
        ->name('v1_deletar_favoritos');

        Route::get('/', 'Favorito@all')
        ->name('v1_obter_favoritos');

        Route::get('/{id}', 'Favorito@find')
        ->name('v1_obter_favorito');
    });

    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')
        ->name('v1_obter_login');

        Route::post('signup', 'AuthController@signup')
        ->name('v1_obter_signup');

        Route::middleware('auth:api')->group(function () {
            Route::get('logout', 'AuthController@logout')
            ->name('v1_obter_logout');

            Route::get('usuario', 'AuthController@user')
            ->name('v1_obter_usuario');
        });
    });
});
