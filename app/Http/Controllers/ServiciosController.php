<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class ServiciosController extends Controller
{
    public static function dataResumenServicios(){
        $data_resumen = DB::select("SELECT * from resumen_tarjetas ORDER BY id_tarjeta, periodo DESC");

        // $lista_tarjetas = DB::select("SELECT * from tarjetas");
        $ultimo_periodo = date('m-y');
        $saldo_total = 0;
        $impagas = 0;
        // foreach ($lista_tarjetas as $tarjeta) {
            foreach ($data_resumen as $resumen) {            
                if ( $resumen->periodo == $ultimo_periodo ) {
                    $saldo_total += $resumen->monto;
                    if ($resumen->activo == 1 && $resumen->pagado == 0) {
                        $impagas++;
                    }
                }
            }
        // }

        $data_resumen = array(
            'impagas' => $impagas,
            'saldo' => $saldo_total,
            'data_completa' => $data_resumen
        );
        $data_resumen = (object)$data_resumen;
        return $data_resumen;
    }

    public static function addServicio(){
        $nombre_servicio = Request::input('nombre_empresa');
        $tipo_servicio = Request::input('servicio');        
        $lista_servicios = DB::select("SELECT * from servicios WHERE nombre_servicio LIKE '".$nombre_servicio."' AND servicio LIKE '".$tipo_servicio."'");
        $existe = 0;
        if (!empty($lista_servicios)) {
            $existe = 1;
        }
        if ( !$existe ) {
            // Insert en DDBB
            $temp = DB::insert("INSERT into servicios (nombre_servicio,servicio) VALUES('".$nombre_servicio."','".$tipo_servicio."')");
            return 1;
        } else {
            return 0;
        }
    }

    public static function borrarResumenTarjeta(){
        $id_pf = Request::input('id_resumen');
        if ( !empty($id_pf) ) {
            $temp = DB::delete("DELETE FROM resumen_tarjetas WHERE id_resumen_tarjeta = ".$id_pf);
            return 1;
        } else {
            return 0;
        }
    }

    public static function pagarResumenTarjeta(){
        $id_pf = Request::input('id_resumen');
        if ( !empty($id_pf) ) {
            $temp = DB::delete("UPDATE FROM resumen_tarjetas SET pagado = 1 WHERE id_resumen_tarjeta = ".$id_pf);
            return 1;
        } else {
            return 0;
        }
    }
}