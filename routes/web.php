<?php

use Illuminate\Support\Facades\Route;

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

// public
Route::get('/', 'HomeController@index');
Route::get('/contact', 'HomeController@contact');
Route::get('/whoarewe', 'HomeController@whoarewe');
Route::get('/roomGallery', 'HomeController@roomGallery');
Route::get('/hallGallery', 'HomeController@hallGallery');
Route::get('/restaurantGallery', 'HomeController@restaurantGallery');

Route::get('/users', 'UserController@index')->middleware('auth', 'webmaster');
Route::get('/users/create', 'UserController@createForm')->middleware('auth', 'webmaster');
Route::get('/users/{id}', 'UserController@details')->middleware('auth', 'webmaster');
Route::get('/users/{id}/edit', 'UserController@edit')->middleware('auth', 'webmaster');
Route::post('/usuariocreado', 'UserController@created')->middleware('auth', 'webmaster');
Route::post('/usuarioeditado', 'UserController@edited')->middleware('auth', 'webmaster');
Route::get('/borrarusuario/{id}', 'UserController@delete')->middleware('auth', 'webmaster');
Route::post('/users', 'UserController@index')->middleware('auth', 'webmaster');

Route::get('/bloqueos', 'BloqueoController@index')->middleware('auth', 'recepcionista');
Route::get('/bloqueos/create', 'BloqueoController@createForm')->middleware('auth', 'recepcionista');
Route::get('/bloqueos/{id}', 'BloqueoController@details')->middleware('auth', 'recepcionista');
Route::get('/bloqueos/{id}/edit', 'BloqueoController@edit')->middleware('auth', 'recepcionista');
Route::post('/bloqueocreado', 'BloqueoController@created')->middleware('auth', 'recepcionista');
Route::post('/bloqueoeditado', 'BloqueoController@edited')->middleware('auth', 'recepcionista');
Route::get('/borrarbloqueo/{id}', 'BloqueoController@delete')->middleware('auth', 'recepcionista');
Route::post('/bloqueos', 'BloqueoController@index')->middleware('auth', 'recepcionista');

Route::get('/servicios', 'ServicioController@index')->middleware('auth', 'webmaster');
Route::get('/servicios/create', 'ServicioController@createForm')->middleware('auth', 'webmaster');
Route::get('/servicios/{id}', 'ServicioController@details')->middleware('auth', 'webmaster');
Route::get('/servicios/{id}/edit', 'ServicioController@edit')->middleware('auth', 'webmaster');
Route::post('/serviciocreado', 'ServicioController@created')->middleware('auth', 'webmaster');
Route::post('/servicioeditado', 'ServicioController@edited')->middleware('auth', 'webmaster');
Route::get('/borrarservicio/{id}', 'ServicioController@delete')->middleware('auth', 'webmaster');
Route::post('/servicios', 'ServicioController@index')->middleware('auth', 'recepcionista');

Route::get('/temporadas', 'TemporadaController@index')->middleware('auth', 'webmaster');
Route::get('/temporadas/create', 'TemporadaController@createForm')->middleware('auth', 'webmaster');
Route::get('/temporadas/{id}', 'TemporadaController@details')->middleware('auth', 'webmaster');
Route::get('/temporadas/{id}/edit', 'TemporadaController@edit')->middleware('auth', 'webmaster');
Route::post('/temporadacreada', 'TemporadaController@created')->middleware('auth', 'webmaster');
Route::post('/temporadaeditada', 'TemporadaController@edited')->middleware('auth', 'webmaster');
Route::get('/borrartemporada/{id}', 'TemporadaController@delete')->middleware('auth', 'webmaster');

Route::get('/estancias', 'EstanciaController@index')->middleware('auth', 'recepcionista');
Route::get('/estancias/create', 'EstanciaController@createForm')->middleware('auth', 'webmaster');
Route::get('/estancias/{id}', 'EstanciaController@details')->middleware('auth');
Route::get('/estancias/{id}/edit', 'EstanciaController@edit')->middleware('auth', 'recepcionista');
Route::post('/estanciacreada', 'EstanciaController@created')->middleware('auth', 'webmaster');
Route::post('/estanciaeditada', 'EstanciaController@edited')->middleware('auth', 'recepcionista');
Route::get('/borrarestancia/{id}', 'EstanciaController@delete')->middleware('auth', 'webmaster');
Route::post('/estancias', 'EstanciaController@index')->middleware('auth', 'webmaster');

Route::get('/reservas', 'ReservaController@index')->middleware('auth');
Route::get('/reservas/habitacion', 'ReservaController@createRoomForm')->middleware('auth');
Route::get('/reservas/{id}', 'ReservaController@details')->middleware('auth'); //middleware para si soy CLIENTE, comprobar si es mía
Route::get('/reservas/{id}/edit', 'ReservaController@edit')->middleware('auth', 'recepcionista'); 
Route::post('/reservacreada', 'ReservaController@created')->middleware('auth');
Route::post('/reservaeditada', 'ReservaController@edited')->middleware('auth', 'recepcionista');
Route::get('/borrarreserva/{id}', 'ReservaController@delete')->middleware('auth', 'recepcionista');
Route::post('/reservas', 'ReservaController@index')->middleware('auth', 'webmaster');
//Route::get('/reservas/habitacion', 'ReservaController@createRoomForm')->middleware('auth');
Route::post('/reservas/habitacion', 'ReservaController@buscarHabitacionesPRUEBA')->middleware('auth');
Route::post('/reservas/buscarhabitacion', 'ReservaController@buscarHabitacionesAjax')->middleware('auth');

Auth::routes();
