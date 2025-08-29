<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Inicio
Route::get('/', 'App\Http\Controllers\Controller@home')->name('inicio'); 

