<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class TarjetasController extends Controller
{
    public static function dataResumenTarjetas(){
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

    public static function addResumenTarjeta(){
        $tarjeta = Request::input('tarjeta');
        $vencimiento = Request::input('vencimiento');
        $corte = Request::input('corte');
        $monto = Request::input('valor');
        $periodo = new \Datetime($corte);
        $periodo = $periodo->format('m-y');
        $data_resumen = DB::select("SELECT * from resumen_tarjetas WHERE id_tarjeta = ".$tarjeta." ORDER BY periodo DESC");
        $existe = 0;
        foreach ($data_resumen as $resumen) {
            if ($resumen->id_tarjeta == $tarjeta && $resumen->periodo == $periodo) {
                $existe = 1;
                break;
            }
        }
        if ( !$existe ) {
            // Insert en DDBB
            $temp = DB::insert("INSERT into resumen_tarjetas (vencimiento,corte,monto,id_tarjeta,periodo) VALUES('".$vencimiento."','".$corte."',".$monto.",".$tarjeta.",'".$periodo."')");
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
            $temp = DB::delete("UPDATE resumen_tarjetas SET pagado = 1 WHERE id_resumen_tarjeta = ".$id_pf);
            return 1;
        } else {
            return 0;
        }
    }
}