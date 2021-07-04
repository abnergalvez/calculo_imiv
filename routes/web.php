<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@index')->name('home');
Route::get('/inicio', 'HomeController@index')->name('inicio');
Route::post('/calcular', 'CalculoController@calculo')->name('calculo_otros');
Route::post('/calcular_deptos', 'CalculoDepartamentosController@calculo')->name('calculo_deptos');
Route::post('/calcular_casas', 'CalculoCasasController@calculo')->name('calculo_casas');
Route::post('/guardar_mixto', 'CalculoMixtoController@guardar')->name('mixto_guardar');
Route::get('/calcular_mixto', 'CalculoMixtoController@calcular')->name('mixto_calcular');
