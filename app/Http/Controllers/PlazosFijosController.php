<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class PlazosFijosController extends Controller
{
    public static function dataResumenPlazoFijo(){
        $data_plazos_fijos = DB::select("SELECT * from plazos_fijos");
        $activo = 0;
        $ganancia = 0;
        if (!empty($data_plazos_fijos)) {
            foreach ($data_plazos_fijos as $pf) {
                if ($pf->activo  == 1) {
                    $activo++;
                    $ganancia += $pf->$valor_devolucion;
                }
            }
        }
        $resumen_plazos_fijos = array(
            'activos' => $activo,
            'ganancias' => 0
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
            $temp = DB::insert("INSERT into plazos_fijos (valor_ingresado,fecha_ingresado,fecha_devolucion,cantidad_dias,valor_devolucion,tipo_plazo_fijo,activo,propietario) VALUES(".$ingresado.",'".$fecha."','".$fecha."',".$dias.",".$devolver.",'".$tipo_pf."',".$activo.",'".$persona."')");

            return 1;
        } else {
            return 0;
        }
    }
}