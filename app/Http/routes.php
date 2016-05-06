<?php


 Route::auth(); 
 Route::get('/', function () {
    return redirect('/login');
 });
    
    
/* kontabb.local/painel/ */   
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function(){

    Route::auth(); 

    Route::get('/', function () {
    return view('painel.master');
 });


});    






