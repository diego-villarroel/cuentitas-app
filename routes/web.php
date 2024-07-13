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
// USUARIOS
Route::get('/login','PollitosController@loginVista');
Route::post('/logearse','PollitosController@logearse');
Route::get('/registro','PollitosController@registroVista');
Route::post('/crear-usuario','PollitosController@tarjetasVista');
Route::get('/reset-password','PollitosController@resetVista');
Route::post('/restablecer-pass','PollitosController@tarjetasVista');
Route::get('/cerrar-sesion','PollitosController@cerrarSesion');
Route::post('/regenerar-clave','PollitosController@reestablecerClave');
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
Route::post('/agregar-inversion','InversionesController@addInversion')->middleware('login');
Route::post('/borrar-inversion','InversionesController@borrarInversion')->middleware('login');
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
Route::post('/detalle-resumen-tarjeta','TarjetasController@detalleResumenTarjeta')->middleware('login');
// PRESUPUESTO
Route::get('/presupuesto','AhorrappController@presupuestoVista')->middleware('login');
Route::post('/agregar-tipo-presupuesto','PresupuestoController@addTipoPresu')->middleware('login');
Route::post('/agregar-presupuesto','PresupuestoController@addPresupuesto')->middleware('login');
Route::post('borrar-presupuesto','PresupuestoController@borrarPresupuesto')->middleware('login');
Route::post('/generar-gasto','PresupuestoController@gastoPresupuesto')->middleware('login');
Route::post('/borrar-gasto','PresupuestoController@borrarGastoPresupuesto')->middleware('login');
// PROMOCIONES
Route::get('/promociones','AhorrappController@promocionesVista')->middleware('login');
Route::post('/agregar-promocion','PromocionController@addPromocion')->middleware('login');