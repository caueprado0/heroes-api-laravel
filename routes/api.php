<?php

Route::prefix('v1')->namespace('Api\\v1')->group(function () {
    Route::get('/', function () {
        return response()->json(["url" =>"/", "sucesso" => true, "mensagem" => "O projeto Shun Aceite de Contratos é um software fechado desenvolvido pela equipe de TI da Psychemedics. "]);
    })->name('v1_index');

    //PERSONAGEM
    Route::prefix('personagem')->group(function () {
        Route::get('/', 'Personagem@all')
        ->name('v1_obter_personagens');

        Route::get('/{personagem}', 'Personagem@find')
        ->name('v1_obter_personagem');
    });

    //PERSONAGEM
    Route::prefix('favoritos')->group(function () {
        Route::post('/{personagemId}', 'Favorito@create')
        ->name('v1_criar_favoritos');

        Route::delete('/{personagemId}', 'Favorito@delete')
        ->name('v1_deletar_favoritos');

        Route::get('/', 'Favorito@all')
        ->name('v1_obter_favoritos');

        Route::get('/{id}', 'Favorito@find')
        ->name('v1_obter_favorito');
    });

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');

        Route::group([
            'middleware' => 'auth:api'
        ], function () {
            Route::get('logout', 'AuthController@logout');
            Route::get('usuario', 'AuthController@user');
        });
    });
});
