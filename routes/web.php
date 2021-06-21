<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@index')->name('home');
Route::get('/inicio', 'HomeController@index')->name('inicio');
Route::post('/calcular', 'CalculoController@calculo')->name('calculo');
