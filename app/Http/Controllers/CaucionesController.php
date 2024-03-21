<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class CaucionesController extends Controller
{
    public static function dataResumenCauciones(){
        $data_cauciones = DB::select("SELECT * from cauciones ORDER BY creado DESC");
        if (!empty($data_cauciones)) {
            $activo = 0;
            $cauciones_mensuales = 0;
            $ganancia_total = 0;
            $ganancia_mensual = 0;
            $cantidad_cauciones = 0;
            $mes = date('m');
            $hoy = new \Datetime();
            $data_cauciones_por_periodo = [];
            $aux = [];
            $periodo = $data_cauciones[0]->periodo;
            $ganancia_neta_periodo = 0;
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
                }
                if ($periodo == $cau->periodo){
                    array_push($aux,$cau);
                    $ganancia_neta_periodo += $cau->ganancia_neta;
                    $cauciones_mensuales ++;
                } else {
                    $aux['total'] = $ganancia_neta_periodo;
                    $aux['cantidad'] = $cauciones_mensuales;
                    $aux['ganancia_promedio'] = $ganancia_neta_periodo/$cauciones_mensuales;
                    $data_cauciones_por_periodo[$periodo] = $aux;
                    $periodo = $cau->periodo;
                    $aux = [];
                    $ganancia_neta_periodo = 0;
                    $cauciones_mensuales = 0;
                }
            }
            $aux['total'] = $ganancia_neta_periodo;
            $aux['cantidad'] = $cauciones_mensuales;
            $aux['ganancia_promedio'] = $ganancia_neta_periodo/$cauciones_mensuales;
            $data_cauciones_por_periodo[$periodo] = $aux;
        }
        // dd($data_cauciones_por_periodo);
        $resumen_cauciones = array(
            'total_cantidad_cauciones' => $cantidad_cauciones,
            'activos' => $activo,
            'ganancias_mensuales' => $ganancia_mensual,
            'ganancia_total' => $ganancia_total,
            'data_completa' => $data_cauciones,
            'data_cauciones_por_periodo' => $data_cauciones_por_periodo
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
            $periodo = new \DateTime($fecha);
            $periodo = $periodo->format('m-y');
            $temp = DB::insert("INSERT into cauciones (valor_ingresado,valor_devolucion,propietario,creado,dias,activo,ganancia_neta,porcentaje_ganancia,porcentaje_anual_ganancia,mes,periodo) VALUES(".$ingresado.",".$devolver.",'".$persona."','".$fecha."',".$dias.",".$activo.",".$ganancia.",".$porcentaje.",".$porcentaje_anual.",".$mes.",'".$periodo."')");

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

    public static function detalleCaucion(){
        $id_caucion = Request::input('id_caucion');
        if ( !empty($id_caucion) ) {
            $data_caucion = DB::select("SELECT * from cauciones WHERE id_caucion = ".$id_caucion);

            return json_encode($data_caucion[0]);
        }
    }
}