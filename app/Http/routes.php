<?php

Route::auth();
Route::get('/', function () {
    return redirect('/login');
});


/* kontabb.local/painel/ */
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function() {

    Route::auth();

    Route::get('/', function () {
        return redirect('painel/clientes');
    });

    Route::controller('/usuarios', 'UsuariosController');
    Route::controller('/clientes', 'ClienteController');
    Route::controller('/obrigacoes', 'ObrigacoesController');
});







