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
Route::get('/','AhorrappController@inicioVista')->middleware('login');
// CAUCIONES
Route::get('/cauciones','AhorrappController@caucionesVista')->middleware('login');
Route::post('/agregar-caucion','CaucionesController@addCaucion')->middleware('login');
Route::post('/borrar-caucion','CaucionesController@borrarCaucion')->middleware('login');
Route::post('/detalle-caucion','CaucionesController@detalleCaucion')->middleware('login');
// PLAZOS FIJOS
Route::get('/plazos-fijos','AhorrappController@plazosFijosVista')->middleware('login');
Route::post('/agregar-plazo-fijo','PlazosFijosController@addPlazoFijo')->middleware('login');
Route::post('/borrar-plazo-fijo','PlazosFijosController@borrarPlazoFijo')->middleware('login');
Route::post('/detalle-plazo-fijo','PlazosFijosController@detallePlazoFijo')->middleware('login');
// INVERSIONES
Route::get('/inversiones','AhorrappController@inversionesVista')->middleware('login');
// SERVICIOS
Route::get('/servicios','AhorrappController@serviciosVista')->middleware('login');
Route::post('/agregar-servicio','ServiciosController@addServicio')->middleware('login');
Route::post('/borrar-servicio','ServiciosController@addServicio')->middleware('login');
Route::post('/agregar-factura','ServiciosController@addFactura')->middleware('login');
Route::post('/borrar-factura','ServiciosController@borrarFactura')->middleware('login');
Route::post('/pagar-factura','ServiciosController@pagarFactura')->middleware('login');
// TARJETAS
Route::get('/tarjetas','AhorrappController@tarjetasVista')->middleware('login');
Route::post('/agregar-resumen-tarjeta','TarjetasController@addResumenTarjeta')->middleware('login');
Route::post('/borrar-resumen-tarjeta','TarjetasController@borrarResumenTarjeta')->middleware('login');
Route::post('/pagar-resumen-tarjeta','TarjetasController@pagarResumenTarjeta')->middleware('login');
// USUARIOS
Route::get('/login','PollitosController@loginVista');
Route::post('/logearse','PollitosController@logearse');
Route::post('/crear-usuario','PollitosController@tarjetasVista');
Route::post('/restablecer-pass','PollitosController@tarjetasVista');
Route::get('/cerrar-sesion','PollitosController@cerrarSesion');