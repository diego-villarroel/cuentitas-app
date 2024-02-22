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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','AhorrappController@inicioVista');
Route::get('/cauciones','AhorrappController@caucionesVista');
Route::get('/plazos-fijos','AhorrappController@plazosFijosVista');
Route::get('/inversiones','AhorrappController@inversionesVista');
Route::get('/servicios','AhorrappController@serviciosVista');
Route::get('/tarjetas','AhorrappController@tarjetasVista');
Route::post('/agregar-plazo-fijo','PlazosFijosController@addPlazoFijo');
Route::post('/agregar-caucion','CaucionesController@addCaucion');
Route::post('/borrar-caucion','CaucionesController@borrarCaucion');
Route::post('/borrar-plazo-fijo','PlazosFijosController@borrarPlazoFijo');