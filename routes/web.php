<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// Inicio
Route::get('/', 'App\Http\Controllers\Controller@home')->name('inicio'); 

// Collections
Route::get('nueva-coleccion','App\Http\Controllers\CollectionsController@creaColeccion')->name('collectionCreate');
Route::get('peliculas-coleccion','App\Http\Controllers\CollectionsController@peliculas')->name('collectionPeliculas');
Route::get('peliculas-genero-coleccion','App\Http\Controllers\CollectionsController@peliculasConGenero')->name('collectionPeliculasGenero');

// metodos de collection
Route::get('coleccion-dividir','App\Http\Controllers\CollectionsController@dividir')->name('collectionDivide');
Route::get('coleccion-json','App\Http\Controllers\CollectionsController@json')->name('collectionJson');
Route::get('coleccion-price','App\Http\Controllers\CollectionsController@metodoPrice')->name('collectionPrice');
Route::get('coleccion-reject','App\Http\Controllers\CollectionsController@filtrado')->name('collectionReject');

