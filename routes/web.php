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

Route::get('/', 'HomeController@index');
Route::get('/users', 'UserController@index')->middleware('auth', 'webmaster');
Route::get('/users/create', 'UserController@createForm')->middleware('auth', 'webmaster');
Route::get('/users/{id}', 'UserController@details')->middleware('auth', 'webmaster');
Route::get('/users/{id}/edit', 'UserController@edit')->middleware('auth', 'webmaster');
Route::post('/usuariocreado', 'UserController@created')->middleware('auth', 'webmaster');
Route::post('/usuarioeditado', 'UserController@edited')->middleware('auth', 'webmaster');
Route::get('/borrarusuario/{id}', 'UserController@delete')->middleware('auth', 'webmaster');

Route::get('/bloqueos', 'BloqueoController@index')->middleware('auth', 'recepcionista');
Route::get('/bloqueos/create', 'BloqueoController@createForm')->middleware('auth', 'recepcionista');
Route::get('/bloqueos/{id}', 'BloqueoController@details')->middleware('auth', 'recepcionista');
Route::get('/bloqueos/{id}/edit', 'BloqueoController@edit')->middleware('auth', 'recepcionista');
Route::post('/bloqueocreado', 'BloqueoController@created')->middleware('auth', 'webmaster');
Route::post('/bloqueoeditado', 'BloqueoController@edited')->middleware('auth', 'webmaster');
Route::get('/borrarbloqueo/{id}', 'BloqueoController@delete')->middleware('auth', 'webmaster');

Route::get('/servicios', 'ServicioController@index')->middleware('auth', 'recepcionista');
Route::get('/servicios/create', 'ServicioController@createForm')->middleware('auth', 'recepcionista');
Route::get('/servicios/{id}', 'ServicioController@details')->middleware('auth', 'recepcionista');
Route::get('/servicios/{id}/edit', 'ServicioController@edit')->middleware('auth', 'recepcionista');

Route::get('/temporadas', 'TemporadaController@index')->middleware('auth', 'webmaster');
Route::get('/temporadas/create', 'TemporadaController@createForm')->middleware('auth', 'webmaster');
Route::get('/temporadas/{id}', 'TemporadaController@details')->middleware('auth', 'webmaster');
Route::get('/temporadas/{id}/edit', 'TemporadaController@edit')->middleware('auth', 'webmaster');
Route::post('/temporadacreada', 'TemporadaController@created')->middleware('auth', 'webmaster');
Route::post('/temporadaeditada', 'TemporadaController@edited')->middleware('auth', 'webmaster');
Route::get('/borrartemporada/{id}', 'TemporadaController@delete')->middleware('auth', 'webmaster');

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
