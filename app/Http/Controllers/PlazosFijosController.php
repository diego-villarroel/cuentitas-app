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
            // Insert en DDBB
            $temp = DB::insert("INSERT into plazos_fijos (valor_ingresado,fecha_ingresado,fecha_devolucion,cantidad_dias,valor_devolucion,tipo_plazo_fijo,activo,propietario,id_banco,ganancia_neta,porcentaje_ganancia,porcentaje_ganancia_anual) VALUES(".$ingresado.",'".$fecha."','".$fecha_devolucion."',".$dias.",".$devolver.",'".$tipo_pf."',".$activo.",'".$persona."',".$banco.",".$neta.",".$porcentaje.",".$porcentaje_anual.")");
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
            $data_pf = DB::select("SELECT * from plazos_fijos WHERE id_plazo_fijo = ".$id_pf);

            return json_encode($data_pf[0]);
        }
    }
}