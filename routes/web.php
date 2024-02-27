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
// HOME
Route::get('/','AhorrappController@inicioVista');
// CAUCIONES
Route::get('/cauciones','AhorrappController@caucionesVista');
Route::post('/agregar-caucion','CaucionesController@addCaucion');
Route::post('/borrar-caucion','CaucionesController@borrarCaucion');
// PLAZOS FIJOS
Route::get('/plazos-fijos','AhorrappController@plazosFijosVista');
Route::post('/agregar-plazo-fijo','PlazosFijosController@addPlazoFijo');
Route::post('/borrar-plazo-fijo','PlazosFijosController@borrarPlazoFijo');
// INVERSIONES
Route::get('/inversiones','AhorrappController@inversionesVista');
// SERVICIOS
Route::get('/servicios','AhorrappController@serviciosVista');
Route::post('/agregar-servicio','ServiciosController@addServicio');
// TARJETAS
Route::get('/tarjetas','AhorrappController@tarjetasVista');
Route::post('/agregar-resumen-tarjeta','TarjetasController@addResumenTarjeta');
Route::post('/borrar-resumen-tarjeta','TarjetasController@borrarResumenTarjeta');
Route::post('/pagar-resumen-tarjeta','TarjetasController@pagarResumenTarjeta');