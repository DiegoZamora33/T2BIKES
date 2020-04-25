<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
///Route::get('/home/competidores', 'Competidores@index')->name('competidores');

//Ruta para los controladores resource
Route::resources([
    '/home/competidores'=>'Competidores', //Controlador de Competidores
    '/home/entrenadores'=>'Entrenadores',  //Controlador de Entrenadores
    'competencias'=>'Competencias', //Controlador Competencias
    'carreras'=>'Carreras', //Controlador Carreras
    'tiposcarrera'=>'TiposCarreras'  //Controlador Tipo de Carreras
]);





