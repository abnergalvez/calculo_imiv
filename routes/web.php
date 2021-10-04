<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/inicio', 'HomeController@index')->name('inicio');
Route::post('/calcular', 'CalculoController@calculo')->name('calculo_otros');
Route::post('/calcular_deptos', 'CalculoDepartamentosController@calculo')->name('calculo_deptos');
Route::post('/calcular_casas', 'CalculoCasasController@calculo')->name('calculo_casas');
Route::post('/guardar_mixto', 'CalculoMixtoController@guardar')->name('mixto_guardar');
Route::get('/calcular_mixto', 'CalculoMixtoController@calcular')->name('mixto_calcular');
Route::get('/borrar_mixto', 'CalculoMixtoController@borrar')->name('mixto_borrar');
Route::post('/enviar_resultados', 'EmailController@enviarResultados')->name('resultados_por_email');
Route::get('/calculo_cesion', 'CalculoCesionController@index')->name('inicio.cesion');
Route::post('/resultado_cesion', 'CalculoCesionController@calculo')->name('calculo.cesion');



/*
|--------------------------------------------------------------------------
|  Admin 
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'namespace' => 'Dashboard\Admin',
        'prefix' => 'admin',
        'middleware' =>['auth','admin']
    ]
    ,function () { 
           
        Route::get('home', 'ProfileController@index')->name('admin.index');        

});
/*
|--------------------------------------------------------------------------
|  Normal 
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'namespace' => 'Dashboard\Normal',
        'prefix' => 'user',
        'middleware' =>['auth','normal']
    ]
    ,function () { 
           
        Route::get('home', 'ProfileController@index')->name('normal.index'); 
});