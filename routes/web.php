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


////////////////////////////////// RUTAS PARA FUNCIONES DE USUARIOS  ////////////////////////////////////
		// Para Acceder aun Perfil de un Usuario
		Route::match(['get', 'post'], '/home/usuarios/perfilUsuario', 'Usuarios@perfilUsuario')->name('perfilUsuario');


////////////////////////////////// RUTAS PARA FUNCIONES DE COMPETIDOR //////////////////////////////////
		// Para Acceder a un Perfil de un Competidor
		Route::match(['get', 'post'], '/home/competidores/perfilCompetidor', 'Competidores@perfilCompetidor')->name('perfilCompetidor');

		// Para Acceder a una Estadistica
		Route::match(['get', 'post'], '/home/competidores/estadistica', 'Competidores@estadistica')->name('estadistica');

		// Para Asignar una Competencia a un Competidor
		Route::match(['get', 'post'], '/home/competidores/asignarCompetencia', 'Competidores@asignarCompetencia')->name('asignarCompetencia');

		// Para obtener info sobre una carrera de un Competidor
		Route::match(['get', 'post'], '/home/competidores/datosPuntajeCarrera', 'Competidores@datosPuntajeCarrera')->name('datosPuntajeCarrera');

		// Para Asignar puntaje de una Carrera de un Competidor
		Route::match(['get', 'post'], '/home/competidores/asignarPuntajeCarrera', 'Competidores@asignarPuntajeCarrera')->name('asignarPuntajeCarrera');

		// Para hacer update de un Competidor
		Route::match(['get', 'post'], '/home/competidores/update', 'Competidores@update')->name('update');

		// Para asignale un entrenador
		Route::match(['get', 'post'], '/home/competidores/asignarEntrenador', 'Competidores@asignarEntrenador')->name('asignarEntrenador');

		// Para quitarle un entrenador
		Route::match(['get', 'post'], '/home/competidores/quitarEntrenador', 'Competidores@quitarEntrenador')->name('quitarEntrenador');

		// Para quitarle una Competencia
		Route::match(['get', 'post'], '/home/competidores/quitarCompetencia', 'Competidores@quitarCompetencia')->name('quitarCompetencia');


////////////////////////////////// RUTAS PARA FUNCIONES DE ENTRENADORES //////////////////////////////////
		// Para Acceder a un Perfil de un Entrenador
		Route::match(['get', 'post'], '/home/entrenadores/perfilEntrenador', 'Entrenadores@perfilEntrenador')->name('perfilEntrenador');		

////////////////////////////////// RUTAS PARA FUNCIONES DE GRAFICAS //////////////////////////////////
		// Para Acceder a la Grafica competidor_competencia_pai
		Route::match(['get', 'post'], '/home/graficas/competidor_competencia_pai', 'Graficas@competidor_competencia_pai')->name('competidor_competencia_pai');

		// Para Acceder a la Grafica competidor_competencia_bar
		Route::match(['get', 'post'], '/home/graficas/competidor_competencia_bar', 'Graficas@competidor_competencia_bar')->name('competidor_competencia_bar');

		// Para Acceder a la Grafica competencia_bar
		Route::match(['get', 'post'], '/home/graficas/competencia_bar', 'Graficas@competencia_bar')->name('competencia_bar');

		// Para Acceder a la Grafica competencia_pai
		Route::match(['get', 'post'], '/home/graficas/competencia_pai', 'Graficas@competencia_pai')->name('competencia_pai');

		// Para Acceder a la Grafica carrera_bar
		Route::match(['get', 'post'], '/home/graficas/carrera_bar', 'Graficas@carrera_bar')->name('carrera_bar');

		// Para Acceder a la Grafica carrera_pai
		Route::match(['get', 'post'], '/home/graficas/carrera_pai', 'Graficas@carrera_pai')->name('carrera_pai');


////////////////////////////////// RUTAS PARA FUNCIONES DE COMPETENCIAS  ////////////////////////////////////
		// Para mostrar el perfil de una Competencia
		Route::match(['get', 'post'], '/home/competencias/perfilCompetencia', 'Competencias@perfilCompetencia')->name('perfilCompetencia');

		// Para Mostrar el numero de competuidores por tabla en la estadistica de una Competencia
		Route::match(['get', 'post'], '/home/competencias/statDinamic', 'Competencias@statDinamic')->name('statDinamic');

		// Para Mostrar modulo de agregar quitar
		Route::match(['get', 'post'], '/home/competencias/agregarQuitar', 'Competencias@agregarQuitar')->name('agregarQuitar');

		// Para Mostrar a quien vamos a quitar de la competencia
		Route::match(['get', 'post'], '/home/competencias/quitarCompetidor', 'Competencias@quitarCompetidor')->name('quitarCompetidor');

		// Para Mostrar una Carrera de una Competencia
		Route::match(['get', 'post'], '/home/carreras/perfilCarrera', 'Carreras@perfilCarrera')->name('perfilCarrera');

		// Para Mostrar puntaje de un competidor en una Carrera de una Competencia
		Route::match(['get', 'post'], '/home/carreras/datosPuntajeCarrera', 'Carreras@datosPuntajeCarrera')->name('datosPuntajeCarrera');

		// Para Mostrar el numero de competuidores por tabla en la estadistica de una Carrera
		Route::match(['get', 'post'], '/home/carreras/statDinamic', 'Carreras@statDinamic')->name('statDinamic');


////////////////////////////////// RUTA PARA FUNCIONE DE BUSCAR  ////////////////////////////////////
		// Para buscar
		Route::match(['get', 'post'], '/home/busqueda/buscar', 'Busqueda@buscar')->name('buscar');

////////////////////////////////// RUTA PARA Finalizar una competencia  ////////////////////////////////////
	Route::post('/home/competencias/finalizarCompetencia' , 'Competencias@finalizarCompetencia')->name('finalizarCompetencia');
	
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