<?php

//Route::auth('clientes');
//Rota publica para logar os clientes do sistema
Route::get('/clientes-login', function () {
    
    if (auth()->guard('logclientes')->check()){
        return redirect('clientes/');
    }
    return view('clientes.login');
});

Route::post('/clientes-login', 'AuthClientesController@postLogin');
Route::get('/clientes-sair', 'AuthClientesController@logout');
//Route::get('/clientes/painel', 'AuthClientesController@getIndex');


Route::auth();

Route::get('/', function () {
    return redirect('/painel');
});


//Rota publica para manipulação de arquivos do Dropbox
Route::controller('/arquivos', 'ArquivosController');


/* kontabb.local/painel/ */
Route::group(['prefix' => 'painel', 'middleware' => ['auth']], function() {

    Route::auth();

    Route::get('/', function () {
        return redirect('painel/clientes');
    });

    Route::controller('/usuarios', 'UsuariosController');
    Route::controller('/clientes', 'ClienteController');
    Route::controller('/obrigacoes', 'ObrigacoesController');
});

/* kontabb.local/clientes/ */
Route::group(['prefix' => 'clientes', 'middleware' => ['auth:logclientes'] ], function() {
    
    
    Route::get('/', 'PainelClienteController@index');
    
    

   
});

 














