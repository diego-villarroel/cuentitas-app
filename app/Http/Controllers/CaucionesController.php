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
                // AGREGAR DATOS
                // $ganancia_neta_string = explode('.',strval($cau->ganancia_neta))[0];
                // if (strlen($ganancia_neta_string) > 3 && strlen($ganancia_neta_string) < 7) {
                //     $miles = strlen($ganancia_neta_string) - 3;
                //     $ganancia_neta_string = substr($ganancia_neta_string, 0, $miles).'.'.substr($ganancia_neta_string, -3);
                // }
                // if (strlen($ganancia_neta_string) > 7 && strlen($ganancia_neta_string) < 9) {
                //     $millones = strlen($ganancia_neta_string) - 6;
                //     $ganancia_neta_string = substr($ganancia_neta_string, 0, $millones).'.'.substr($ganancia_neta_string, -6, -4).'.'.substr($ganancia_neta_string, -3);
                // }
                // if (isset(explode('.',strval($cau->ganancia_neta))[1])) {
                //     $ganancia_neta_string .= ','.substr(explode('.',strval($cau->ganancia_neta))[1],0,2);
                // }

                // $valor_ingresado_string = explode('.',strval($cau->valor_ingresado))[0];
                // if (strlen($valor_ingresado_string) > 3 && strlen($valor_ingresado_string) < 7) {
                //     $miles = strlen($valor_ingresado_string) - 3;
                //     $valor_ingresado_string = substr($valor_ingresado_string, 0, $miles).'.'.substr($valor_ingresado_string, -3);
                // }
                // if (strlen($valor_ingresado_string) > 7 && strlen($valor_ingresado_string) < 9) {
                //     $millones = strlen($valor_ingresado_string) - 6;
                //     $valor_ingresado_string = substr($valor_ingresado_string, 0, $millones).'.'.substr($valor_ingresado_string, -6, -4).'.'.substr($valor_ingresado_string, -3);
                // }
                // if (isset(explode('.',strval($cau->valor_ingresado))[1])) {
                //     $valor_ingresado_string .= ','.substr(explode('.',strval($cau->valor_ingresado))[1],0,2);
                // }

                // $valor_devolucion_string = explode('.',strval($cau->valor_devolucion))[0];
                // if (strlen($valor_devolucion_string) > 3 && strlen($valor_devolucion_string) < 7) {
                //     $miles = strlen($valor_devolucion_string) - 3;
                //     $valor_devolucion_string = substr($valor_devolucion_string, 0, $miles).'.'.substr($valor_devolucion_string, -3);
                // }
                // if (strlen($valor_devolucion_string) > 7 && strlen($valor_devolucion_string) < 9) {
                //     $millones = strlen($valor_devolucion_string) - 6;
                //     $valor_devolucion_string = substr($valor_devolucion_string, 0, $millones).'.'.substr($valor_devolucion_string, -6, -4).'.'.substr($valor_devolucion_string, -3);
                // }
                // if (isset(explode('.',strval($cau->valor_devolucion))[1])) {
                //     $valor_devolucion_string .= ','.substr(explode('.',strval($cau->valor_devolucion))[1],0,2);
                // }

                // $porcentaje_ganancia_string = explode('.',strval($cau->porcentaje_ganancia))[0].'.'.substr(explode('.',strval($cau->porcentaje_ganancia))[1],0,2);

                // $porcentaje_anual_ganancia_string = explode('.',strval($cau->porcentaje_anual_ganancia))[0].'.'.substr(explode('.',strval($cau->porcentaje_anual_ganancia))[1],0,2);
                
                // $meses_del_año = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];

                // $mes = $meses_del_año[$cau->mes];
                // DB::update("UPDATE cauciones SET ganancia_neta_string = '".$ganancia_neta_string."', porcentaje_ganancia_string = '".$porcentaje_ganancia_string."', porcentaje_anual_ganancia_string = '".$porcentaje_anual_ganancia_string."', mes_string = '".$mes."', ingresado_string = '".$valor_ingresado_string."', devolucion_string = '".$valor_devolucion_string."' WHERE id_caucion = ".$cau->id_caucion);
                
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
            // 
            $ganancia_neta_string = explode('.',strval($ganancia))[0];
            if (strlen($ganancia_neta_string) > 3 && strlen($ganancia_neta_string) < 7) {
                $miles = strlen($ganancia_neta_string) - 3;
                $ganancia_neta_string = substr($ganancia_neta_string, 0, $miles).'.'.substr($ganancia_neta_string, -3);
            }
            if (strlen($ganancia_neta_string) > 7 && strlen($ganancia_neta_string) < 9) {
                $millones = strlen($ganancia_neta_string) - 6;
                $ganancia_neta_string = substr($ganancia_neta_string, 0, $millones).'.'.substr($ganancia_neta_string, -6, -4).'.'.substr($ganancia_neta_string, -3);
            }
            if (isset(explode('.',strval($ganancia))[1])) {
                $ganancia_neta_string .= ','.substr(explode('.',strval($ganancia))[1],0,2);
            }
            // 
            $porcentaje_ganancia_string = explode('.',strval($porcentaje))[0].'.'.substr(explode('.',strval($porcentaje))[1],0,2);
            // 
            $porcentaje_anual_ganancia_string = explode('.',strval($porcentaje_anual))[0].'.'.substr(explode('.',strval($porcentaje_anual))[1],0,2);
            // 
            $meses_del_año = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
            $mes_string = $meses_del_año[intval($mes)];
            // 
            $valor_ingresado_string = explode('.',strval($ingresado))[0];
            if (strlen($valor_ingresado_string) > 3 && strlen($valor_ingresado_string) < 7) {
                $miles = strlen($valor_ingresado_string) - 3;
                $valor_ingresado_string = substr($valor_ingresado_string, 0, $miles).'.'.substr($valor_ingresado_string, -3);
            }
            if (strlen($valor_ingresado_string) > 7 && strlen($valor_ingresado_string) < 9) {
                $millones = strlen($valor_ingresado_string) - 6;
                $valor_ingresado_string = substr($valor_ingresado_string, 0, $millones).'.'.substr($valor_ingresado_string, -6, -4).'.'.substr($valor_ingresado_string, -3);
            }
            if (isset(explode('.',strval($ingresado))[1])) {
                $valor_ingresado_string .= ','.substr(explode('.',strval($ingresado))[1],0,2);
            }
            // 
            $valor_devolucion_string = explode('.',strval($devolver))[0];
            if (strlen($valor_devolucion_string) > 3 && strlen($valor_devolucion_string) < 7) {
                $miles = strlen($valor_devolucion_string) - 3;
                $valor_devolucion_string = substr($valor_devolucion_string, 0, $miles).'.'.substr($valor_devolucion_string, -3);
            }
            if (strlen($valor_devolucion_string) > 7 && strlen($valor_devolucion_string) < 9) {
                $millones = strlen($valor_devolucion_string) - 6;
                $valor_devolucion_string = substr($valor_devolucion_string, 0, $millones).'.'.substr($valor_devolucion_string, -6, -4).'.'.substr($valor_devolucion_string, -3);
            }
            if (isset(explode('.',strval($devolver))[1])) {
                $valor_devolucion_string .= ','.substr(explode('.',strval($devolver))[1],0,2);
            }
            // 
            $temp = DB::insert("INSERT into cauciones (valor_ingresado,valor_devolucion,propietario,creado,dias,activo,ganancia_neta,porcentaje_ganancia,porcentaje_anual_ganancia,mes,periodo,ganancia_neta_string,porcentaje_ganancia_string,porcentaje_anual_ganancia_string,mes_string,ingresado_string,devolucion_string) VALUES(".$ingresado.",".$devolver.",'".$persona."','".$fecha."',".$dias.",".$activo.",".$ganancia.",".$porcentaje.",".$porcentaje_anual.",".$mes.",'".$periodo.",'".$ganancia_neta_string.",'".$ganancia_neta_string.",'".$porcentaje_ganancia_string.",'".$mes_string.",'".$valor_ingresado_string.",'".$valor_devolucion_string."')");

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
            $data_caucion = DB::select("SELECT C.ingresado_string AS valor_ingresado, C.devolucion_string AS valor_devolucion, C.creado, C.dias, C.ganancia_neta_string AS ganancia_neta, C.porcentaje_ganancia_string AS porcentaje_ganancia, C.porcentaje_anual_ganancia_string AS porcentaje_anual_ganancia, C.mes_string AS mes, P.nombre, P.apellido from cauciones AS C INNER JOIN pollitos AS P ON P.id_pollito = C.propietario WHERE id_caucion = ".$id_caucion);

            return json_encode($data_caucion[0]);
        }
    }
}