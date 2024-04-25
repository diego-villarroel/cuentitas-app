<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class PlazosFijosController extends Controller
{
    public static function dataResumenPlazoFijo(){
        $data_plazos_fijos = DB::select("SELECT * from plazos_fijos ORDER BY tipo_plazo_fijo");
        $activo = 0;
        $activo_tradi = 0;
        $activo_uva = 0;
        $ganancia_activa = 0;
        $ganancia_tradi = 0;
        $ganancia_uva = 0;
        if (!empty($data_plazos_fijos)) {
            foreach ($data_plazos_fijos as $pf) {
                if ($pf->activo  == 1) {
                    $activo++;
                    $ganancia_activa += $pf->ganancia_neta;
                }
                if ($pf->tipo_plazo_fijo == 2) {
                    $ganancia_tradi += $pf->ganancia_neta;
                    if ($pf->activo  == 1) {
                        $activo_tradi++;
                    }
                } else {
                    $ganancia_uva += $pf->ganancia_neta;
                    if ($pf->activo  == 1) {
                        $activo_uva++;
                    }
                }

                // AGREGAR DATOS
                // $ganancia_neta_string = explode('.',strval($pf->ganancia_neta))[0];
                // if (strlen($ganancia_neta_string) > 3 && strlen($ganancia_neta_string) < 7) {
                //     $miles = strlen($ganancia_neta_string) - 3;
                //     $ganancia_neta_string = substr($ganancia_neta_string, 0, $miles).'.'.substr($ganancia_neta_string, -3);
                // }
                // if (strlen($ganancia_neta_string) > 7 && strlen($ganancia_neta_string) < 9) {
                //     $millones = strlen($ganancia_neta_string) - 6;
                //     $ganancia_neta_string = substr($ganancia_neta_string, 0, $millones).'.'.substr($ganancia_neta_string, -6, -4).'.'.substr($ganancia_neta_string, -3);
                // }
                // if (isset(explode('.',strval($pf->ganancia_neta))[1])) {
                //     $ganancia_neta_string .= ','.explode('.',strval($pf->ganancia_neta))[1];
                // }

                // $valor_ingresado_string = explode('.',strval($pf->valor_ingresado))[0];
                // if (strlen($valor_ingresado_string) > 3 && strlen($valor_ingresado_string) < 7) {
                //     $miles = strlen($valor_ingresado_string) - 3;
                //     $valor_ingresado_string = substr($valor_ingresado_string, 0, $miles).'.'.substr($valor_ingresado_string, -3);
                // }
                // if (strlen($valor_ingresado_string) > 7 && strlen($valor_ingresado_string) < 9) {
                //     $millones = strlen($valor_ingresado_string) - 6;
                //     $valor_ingresado_string = substr($valor_ingresado_string, 0, $millones).'.'.substr($valor_ingresado_string, -6, -4).'.'.substr($valor_ingresado_string, -3);
                // }
                // if (isset(explode('.',strval($pf->valor_ingresado))[1])) {
                //     $valor_ingresado_string .= ','.substr(explode('.',strval($pf->valor_ingresado))[1],0,2);
                // }

                // $valor_devolucion_string = explode('.',strval($pf->valor_devolucion))[0];
                // if (strlen($valor_devolucion_string) > 3 && strlen($valor_devolucion_string) < 7) {
                //     $miles = strlen($valor_devolucion_string) - 3;
                //     $valor_devolucion_string = substr($valor_devolucion_string, 0, $miles).'.'.substr($valor_devolucion_string, -3);
                // }
                // if (strlen($valor_devolucion_string) > 7 && strlen($valor_devolucion_string) < 9) {
                //     $millones = strlen($valor_devolucion_string) - 6;
                //     $valor_devolucion_string = substr($valor_devolucion_string, 0, $millones).'.'.substr($valor_devolucion_string, -6, -4).'.'.substr($valor_devolucion_string, -3);
                // }
                // if (isset(explode('.',strval($pf->valor_devolucion))[1])) {
                //     $valor_devolucion_string .= ','.substr(explode('.',strval($pf->valor_devolucion))[1],0,2);
                // }
                // // 
                // $porcentaje_ganancia_string = explode('.',strval($pf->porcentaje_ganancia))[0];
                // if (isset(explode('.',strval($pf->porcentaje_ganancia))[1])) {
                //     $porcentaje_ganancia_string .= '.'.substr(explode('.',strval($pf->porcentaje_ganancia))[1],0,2);
                // }
                // // 
                // $porcentaje_anual_ganancia_string = explode('.',strval($pf->porcentaje_ganancia_anual))[0];
                // if (explode('.',strval($pf->porcentaje_ganancia_anual))[1]) {
                //     $porcentaje_anual_ganancia_string .= '.'.substr(explode('.',strval($pf->porcentaje_ganancia_anual))[1],0,2);
                // }
                // // 
                // DB::update("UPDATE plazos_fijos SET ganancia_neta_string = '".$ganancia_neta_string."', porcentaje_ganancia_string = '".$porcentaje_ganancia_string."', porcentaje_ganancia_anual_string = '".$porcentaje_anual_ganancia_string."', ingresado_string = '".$valor_ingresado_string."', devolucion_string = '".$valor_devolucion_string."' WHERE id_plazo_fijo = ".$pf->id_plazo_fijo);
                
            }
        }
        $resumen_plazos_fijos = array(
            'activos' => $activo,
            'activos_tradi' => $activo_tradi,
            'activos_uva' => $activo_uva,
            'ganancia_activa' => $ganancia_activa,
            'ganancia_tradi' => $ganancia_tradi,
            'ganancia_uva' => $ganancia_uva,
            'data_pf' => $data_plazos_fijos
        );
        $resumen_plazos_fijos = (object)$resumen_plazos_fijos;
        return $resumen_plazos_fijos;
    }

    public static function addPlazoFijo(){
        $ingresado = Request::input('ingresado');
        $devolver = Request::input('devolver');
        $persona = Request::input('persona');
        $banco = Request::input('banco');
        $tipo_pf = Request::input('tipo_pf');
        $fecha = Request::input('fecha');
        $dias = Request::input('dias');
        $activo = Request::input('activo');
        if ( !empty($ingresado) && !empty($devolver) && !empty($persona) && !empty($banco) && !empty($tipo_pf) && !empty($fecha) && !empty($dias) && HelperController::validarMonto($ingresado) && HelperController::validarMonto($devolver) ) {
            // Calculo del día de devolución segun los días ingresados
            $fecha_devolucion = new \Datetime($fecha);
            $fecha_devolucion = date_add($fecha_devolucion,new \DateInterval('P'.$dias.'D'));
            $fecha_devolucion = $fecha_devolucion->format('Y-m-d');
            // Calculo de ganancia neta y porcentajes
            $neta = $devolver - $ingresado;
            $porcentaje = ($neta*100)/$ingresado;
            $porcentaje_anual = ($porcentaje*30*12)/$dias;
            // Parseo de variables a string para mostrar
            $ganancia_neta_string = explode('.',strval($neta))[0];
            if (strlen($ganancia_neta_string) > 3 && strlen($ganancia_neta_string) < 7) {
                $miles = strlen($ganancia_neta_string) - 3;
                $ganancia_neta_string = substr($ganancia_neta_string, 0, $miles).'.'.substr($ganancia_neta_string, -3);
            }
            if (strlen($ganancia_neta_string) > 7 && strlen($ganancia_neta_string) < 9) {
                $millones = strlen($ganancia_neta_string) - 6;
                $ganancia_neta_string = substr($ganancia_neta_string, 0, $millones).'.'.substr($ganancia_neta_string, -6, -4).'.'.substr($ganancia_neta_string, -3);
            }
            if (isset(explode('.',strval($neta))[1])) {
                $ganancia_neta_string .= ','.explode('.',strval($neta))[1];
            }
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
            $porcentaje_ganancia_string = explode('.',strval($porcentaje))[0];
            if (isset(explode('.',strval($porcentaje))[1])) {
                $porcentaje_ganancia_string .= '.'.substr(explode('.',strval($porcentaje))[1],0,2);
            }
            // 
            $porcentaje_anual_ganancia_string = explode('.',strval($porcentaje_anual))[0];
            if (explode('.',strval($porcentaje_anual))[1]) {
                $porcentaje_anual_ganancia_string .= '.'.substr(explode('.',strval($porcentaje_anual))[1],0,2);
            }
            // Insert en DDBB
            $temp = DB::insert("INSERT into plazos_fijos (valor_ingresado,fecha_ingresado,fecha_devolucion,cantidad_dias,valor_devolucion,tipo_plazo_fijo,activo,propietario,id_banco,ganancia_neta,porcentaje_ganancia,porcentaje_ganancia_anual,ganancia_neta_string,porcentaje_ganancia_string,porcentaje_ganancia_anual_string,ingresado_string,devolucion_string) VALUES(".$ingresado.",'".$fecha."','".$fecha_devolucion."',".$dias.",".$devolver.",'".$tipo_pf."',".$activo.",'".$persona."',".$banco.",".$neta.",".$porcentaje.",".$porcentaje_anual.",'".$ganancia_neta_string."',".$porcentaje_ganancia_string.",".$porcentaje_anual_ganancia_string.",".$valor_ingresado_string.",".$valor_devolucion_string.")");
            return 1;
        } else {
            return 0;
        }
    }

    public static function borrarPlazoFijo(){
        $id_pf = Request::input('id_plazo_fijo');
        if ( !empty($id_pf) ) {
            $temp = DB::delete("DELETE FROM cauciones WHERE id_plazo_fijo = ".$id_pf);
            return 1;
        } else {
            return 0;
        }
    }

    public static function detallePlazoFijo(){
        $id_pf = Request::input('id_plazo_fijo');
        if ( !empty($id_pf) ) {
            $data_pf = DB::select("SELECT pf.ingresado_string, pf.devolucion_string, pf.porcentaje_ganancia_anual_string, pf.porcentaje_ganancia_string, pf.ganancia_neta_string, pf.fecha_ingresado, pf.fecha_devolucion, pf.cantidad_dias, b.nombre AS nombre_banco, tipopf.nombre_tipo_pf, pollitos.nombre as nombre_p, pollitos.apellido as apellido_p from plazos_fijos AS pf INNER JOIN bancos as b ON pf.id_banco = b.id_bancos INNER JOIN tipo_plazo_fijo as tipopf ON pf.tipo_plazo_fijo = tipopf.id_tipo_pf INNER JOIN pollitos ON pf.propietario = pollitos.id_pollito WHERE pf.id_plazo_fijo = ".$id_pf);

            return json_encode($data_pf[0]);
        }
    }
}