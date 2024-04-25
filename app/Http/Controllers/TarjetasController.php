<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class TarjetasController extends Controller
{
    public static function dataResumenTarjetas(){
        $data_resumen = DB::select("SELECT * from resumen_tarjetas ORDER BY id_tarjeta, periodo DESC");
        // $ultimo_periodo = date('m-y');
        $hoy = new \DateTime;
        $por_vencer = $hoy->modify('-1 day');
        $saldo_total = 0;
        $impagas = 0;
        $resumenes_vencidos = [];
        $resumenes_por_vencer = [];
        foreach ($data_resumen as $resumen) {
            if ($resumen->pagado == 0) {
                $vencimiento = new \Datetime($resumen->vencimiento);
                if ( $vencimiento < $hoy ) {
                    array_push($resumenes_vencidos,$resumen);
                    $saldo_total += $resumen->monto;
                    $impagas++;
                } elseif ( $vencimiento->format('d-m-Y') == $por_vencer->format('d-m-Y') ) {
                    array_push($resumenes_por_vencer,$resumen);
                }
            }  
            // AGREGAR DATOS
            // $monto_string = explode('.',strval($resumen->monto))[0];
            // if (strlen($monto_string) > 3 && strlen($monto_string ) < 7) {
            //     $miles = strlen($monto_string) - 3;
            //     $monto_string = substr($monto_string, 0, $miles).'.'.substr($monto_string, -3);
            // }
            // if (strlen($monto_string) > 7 && strlen($monto_string) < 9) {
            //     $millones = strlen($monto_string) - 6;
            //     $monto_string = substr($monto_string, 0, $millones).'.'.substr($monto_string, -6, -4).'.'.substr($monto_string, -3);
            // }
            // if (isset(explode('.',strval($resumen->monto))[1])) {
            //     $monto_string .= ','.explode('.',strval($resumen->monto))[1];
            // }
            
            // $meses_del_año = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
            // $mes = substr($resumen->periodo, 1, 2);
            // $mes = $meses_del_año[intval($mes)];

            // DB::update("UPDATE resumen_tarjetas SET monto_string = '".$monto_string."', mes_string = '".$mes."' WHERE id_resumen_tarjeta = ".$resumen->id_resumen_tarjeta);
            
        }
        $data_resumen = array(
            'impagas' => $impagas,
            'saldo' => $saldo_total,
            'resumenes_vencidos' => $resumenes_vencidos,
            'resumenes_por_vencer' => $resumenes_por_vencer,
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
            $monto_string = explode('.',strval($monto))[0];
            if (strlen($monto_string) > 3 && strlen($monto_string ) < 7) {
                $miles = strlen($monto_string) - 3;
                $monto_string = substr($monto_string, 0, $miles).'.'.substr($monto_string, -3);
            }
            if (strlen($monto_string) > 7 && strlen($monto_string) < 9) {
                $millones = strlen($monto_string) - 6;
                $monto_string = substr($monto_string, 0, $millones).'.'.substr($monto_string, -6, -4).'.'.substr($monto_string, -3);
            }
            if (isset(explode('.',strval($monto))[1])) {
                $monto_string .= ','.explode('.',strval($monto))[1];
            }
            // 
            $meses_del_año = ['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
            $mes = substr($periodo, 1, 2);
            $mes = $meses_del_año[intval($mes)];
            // Insert en DDBB
            $temp = DB::insert("INSERT into resumen_tarjetas (vencimiento,corte,monto,id_tarjeta,periodo,monto_string,mes_string) VALUES('".$vencimiento."','".$corte."',".$monto.",".$tarjeta.",'".$periodo.",".$monto_string.",'".$mes."')");
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