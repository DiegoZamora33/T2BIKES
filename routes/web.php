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

// Para Acceder a un Perfil de un Competidor
Route::match(['get', 'post'], '/home/competidores/perfilCompetidor', 'Competidores@perfilCompetidor')->name('perfilCompetidor');

// Para Acceder a una Estadistica
Route::match(['get', 'post'], '/home/competidores/estadistica', 'Competidores@estadistica')->name('estadistica');

// Para Asignar una Competencia a un Competidor
Route::match(['get', 'post'], '/home/competidores/asignarCompetencia', 'Competidores@asignarCompetencia')->name('asignarCompetencia');

// Para obtener info sobre una carrera de un Competidor
Route::match(['get', 'post'], '/home/competidores/datosPuntajeCarrera', 'Competidores@datosPuntajeCarrera')->name('datosPuntajeCarrera');

// Para hacer update de un Competidor
Route::match(['get', 'post'], '/home/competidores/update', 'Competidores@update')->name('update');

// Para Acceder a la Grafica competidor_competencia_pai
Route::match(['get', 'post'], '/home/graficas/competidor_competencia_pai', 'Graficas@competidor_competencia_pai')->name('competidor_competencia_pai');

// Para Acceder a la Grafica competidor_competencia_bar
Route::match(['get', 'post'], '/home/graficas/competidor_competencia_bar', 'Graficas@competidor_competencia_bar')->name('competidor_competencia_bar');



//Ruta para los controladores resource
Route::resources([
    '/home/competidores'=>'Competidores', //Controlador de Competidores
    '/home/entrenadores'=>'Entrenadores',  //Controlador de Entrenadores
    '/home/competencias'=>'Competencias', //Controlador Competencias
    '/home/carreras'=>'Carreras', //Controlador Carreras
    '/home/tiposcarrera'=>'TiposCarreras',  //Controlador Tipo de Carreras
    '/home/usuarios'=>'Usuarios',  //Controlador Usuarios
    '/home/graficas'=>'Graficas',  //Controlador Graficas
]);

//Prueba AJAX
Route::get('/ajax', function () {
    return view('pruebaAJAX');
});