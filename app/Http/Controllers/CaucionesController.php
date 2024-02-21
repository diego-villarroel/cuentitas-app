<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class CaucionesController extends Controller
{
    public static function dataResumenCauciones(){
        $data_cauciones = DB::select("SELECT * from cauciones ORDER BY creado");
        $activo = 0;
        $cauciones_mensuales = 0;
        $ganancia_total = 0;
        $ganancia_mensual = 0;
        $cantidad_cauciones = 0;
        $mes = date('m');
        $hoy = new \Datetime();
        if (!empty($data_cauciones)) {
            foreach ($data_cauciones as $cau) {
                $cantidad_cauciones++;
                $ganancia_total += $cau->ganancia_neta;
                $creado = new \Datetime($cau->creado);
                $paso_dias = date_diff($hoy,$creado);
                if ($paso_dias->d > $cau->dias && $cau->activo == 1) {
                    $temp = DB::update("UPDATE cauciones SET activo = 0 WHERE id_caucion = ".$cau->id_caucion);
                }
                if ($cau->activo  == 1) {
                    $activo++;
                }
                if ($mes == $cau->mes) {
                    $ganancia_mensual += $cau->ganancia_neta;
                    $cauciones_mensuales ++;
                }
            }
        }
        $resumen_cauciones = array(
            'total_cantidad_cauciones' => $cantidad_cauciones,
            'activos' => $activo,
            'cauciones_mensuales' => $cauciones_mensuales,
            'ganancias_mensuales' => $ganancia_mensual,
            'ganancia_total' => $ganancia_total,
            'data_completa' => $data_cauciones
        );
        $resumen_cauciones = (object)$resumen_cauciones;
        return $resumen_cauciones;
    }

    public static function addCaucion(){
        $ingresado = Request::input('ingresado');
        $devolver = Request::input('devolver');
        $persona = Request::input('nombre');
        $fecha = Request::input('fecha');
        $dias = Request::input('dias');
        $activo = Request::input('activo');
        if ( !empty($ingresado) && !empty($devolver) && !empty($persona) && !empty($fecha) && !empty($dias) && HelperController::validarMonto($ingresado) && HelperController::validarMonto($devolver) ) {
            $ganancia = $devolver - $ingresado;
            $porcentaje = ($ganancia*100)/$ingresado;
            $porcentaje_anual = ($porcentaje*30*12)/$dias;
            $mes = explode('-',$fecha)[1];
            $temp = DB::insert("INSERT into cauciones (valor_ingresado,valor_devolucion,propietario,creado,dias,activo,ganancia_neta,porcentaje_ganancia,porcentaje_anual_ganancia,mes) VALUES(".$ingresado.",".$devolver.",'".$persona."','".$fecha."',".$dias.",".$activo.",".$ganancia.",".$porcentaje.",".$porcentaje_anual.",".$mes.")");

            return 1;
        } else {
            return 0;
        }
    }

    public static function borrarCaucion(){
        $id_caucion = Request::input('id_caucion');
        if ( !empty($id_caucion) ) {
            $temp = DB::delete("DELETE FROM cauciones WHERE id_caucion = ".$id_caucion);
            return 1;
        } else {
            return 0;
        }
    }
}