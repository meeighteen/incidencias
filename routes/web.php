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

Route::get('/home', 'HomeController@index');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');

// Incidencias
Route::get('/reportar', 'IncidentController@create');
Route::post('/reportar', 'IncidentController@store');

Route::get('/incidencia/{id}/editar', 'IncidentController@edit');
Route::post('/incidencia/{id}/editar', 'IncidentController@update');

Route::get('/ver','IncidentController@showall');

Route::get('/ver/{id}', 'IncidentController@show');
Route::get('/pendiente','IncidentController@pendiente');
Route::get('/enproceso','IncidentController@enproceso');
Route::get('/resuelto','IncidentController@resuelto');

Route::get('/incidencia/{id}/atender', 'IncidentController@take');
Route::get('/incidencia/{id}/resolver', 'IncidentController@solve');
Route::get('/incidencia/{id}/abrir', 'IncidentController@open');
Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel');

// Mensajes
Route::post('/mensajes', 'MessageController@store');



Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function(){
	//Usuarios
	Route::get('/usuarios', 'UserController@index');
	Route::post('/usuarios', 'UserController@store');
	
	Route::get('/usuario/{id}', 'UserController@edit');
	Route::post('/usuario/{id}', 'UserController@update');

	Route::get('/usuario/{id}/eliminar', 'UserController@delete');

	//solicitudes
	Route::get('/solicitudes', 'ProjectController@index');
	Route::post('/solicitudes', 'ProjectController@store');

	Route::get('/solicitud/{id}', 'ProjectController@edit');
	Route::post('/solicitud/{id}', 'ProjectController@update');

	Route::get('/solicitud/{id}/eliminar', 'ProjectController@delete');
	Route::get('/solicitud/{id}/restaurar', 'ProjectController@restore');
	
	//Categorias
	Route::post('/categorias','CategoryController@store');
	Route::post('/categoria/editar','CategoryController@update');
	Route::get('/categoria/{id}/eliminar','CategoryController@delete');

	//Nivel
	Route::post('/niveles','LevelController@store');
	Route::post('/nivel/editar','LevelController@update');
	Route::get('/nivel/{id}/eliminar','LevelController@delete');

	//proyecto-usuario
	Route::post('/proyecto-usuario','ProjectUserController@store');
	Route::get('/proyecto-usuario/{id}/eliminar','ProjectUserController@delete');

	Route::get('/config', 'ConfigController@index');
});