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

// Para Acceder aun Perfil de un Usuario
Route::match(['get', 'post'], '/home/usuarios/perfilUsuario', 'Usuarios@perfilUsuario')->name('perfilUsuario');

// Para Acceder aun Perfil de un Competidor
Route::match(['get', 'post'], '/home/competidores/perfilCompetidor', 'Competidores@perfilCompetidor')->name('perfilCompetidor');




//Ruta para los controladores resource
Route::resources([
    '/home/competidores'=>'Competidores', //Controlador de Competidores
    '/home/entrenadores'=>'Entrenadores',  //Controlador de Entrenadores
    '/home/competencias'=>'Competencias', //Controlador Competencias
    '/home/carreras'=>'Carreras', //Controlador Carreras
    '/home/tiposcarrera'=>'TiposCarreras',  //Controlador Tipo de Carreras
    '/home/usuarios'=>'Usuarios',  //Controlador Usuarios
]);

//Prueba AJAX
Route::get('/ajax', function () {
    return view('pruebaAJAX');
});



