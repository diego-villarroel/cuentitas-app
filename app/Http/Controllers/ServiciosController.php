<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class ServiciosController extends Controller
{
    public static function dataResumenServicios(){
        $data_resumen = DB::select("SELECT * from resumen_tarjetas ORDER BY id_tarjeta, periodo DESC");
        $ultimo_periodo = date('m-y');
        $saldo_total = 0;
        $impagas = 0;
        foreach ($data_resumen as $resumen) {            
            if ( $resumen->periodo == $ultimo_periodo ) {
                $saldo_total += $resumen->monto;
                if ($resumen->activo == 1 && $resumen->pagado == 0) {
                    $impagas++;
                }
            }
        }

        $data_resumen = array(
            'impagas' => $impagas,
            'saldo' => $saldo_total,
            'data_completa' => $data_resumen
        );
        $data_resumen = (object)$data_resumen;
        return $data_resumen;
    }

    public static function dataFacturas() {
        $servicios = DB::select("SELECT * FROM servicios");
        $data_completa = DB::select("SELECT * FROM facturas_servicio ORDER BY id_servicio, vencimiento DESC");
        $data_por_servicio = [];
        $vencidas = [];
        $por_vencer = [];
        $lista_vencimientos = [];
        $hoy = new \DateTime;
        $por_vencer_fecha = $hoy->modify('-1 day');
        $impagas = 0;
        $saldo_total = 0;

        foreach ($servicios as $k => $serv) {
            $id_serv = $serv->id_servicio;
            $facturas_serv = [];
            foreach ($data_completa as $factura) {
                if ($id_serv == $factura->id_servicio ) {
                    array_push($facturas_serv,$factura);
                }
                if ($k == 0 && $factura->pagado == 0) {
                    $impagas++;
                    $saldo_total += $factura->monto;
                    array_push($lista_vencimientos,$serv->nombre_servicio.' '.$factura->vencimiento);
                    $vencimiento_comparacion = !is_null($factura->segundo_vencimiento) ? new \DateTime($factura->segundo_vencimiento) : new \DateTime($factura->vencimiento);
                    if ( $vencimiento_comparacion < $hoy ) {
                        array_push($vencidas,$factura);
                    } elseif ($vencimiento_comparacion->format('d-m-Y') == $por_vencer_fecha->format('d-m-Y')) {
                        array_push($por_vencer,$factura);
                    }
                }
            }
            $data_por_servicio[$id_serv] = $facturas_serv;
        }
        $data_facturas = array(
            'impagas' => $impagas,
            'monto_total' => $saldo_total,
            'vencidas' => $vencidas,
            'por_vencer' => $por_vencer,
            'data_completa' => $data_completa,
            'data_por_servicio' => $data_por_servicio,
        );
        $data_facturas = (object)$data_facturas;
        return $data_facturas;
    }

    public static function addServicio(){
        $nombre_servicio = Request::input('nombre_empresa');
        $tipo_servicio = Request::input('servicio');
        $de_casa = Request::input('de_casa');
        $lista_servicios = DB::select("SELECT * from servicios WHERE nombre_servicio LIKE '".$nombre_servicio."' AND servicio LIKE '".$tipo_servicio."'");
        $existe = 0;
        if (!empty($lista_servicios)) {
            $existe = 1;
        }
        if ( !$existe ) {
            // Insert en DDBB
            $temp = DB::insert("INSERT into servicios (nombre_servicio,servicio,de_casa) VALUES('".$nombre_servicio."','".$tipo_servicio."',".$de_casa.")");
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

    public static function pagarFactura(){
        $id_factura = Request::input('id_factura');
        if ( !empty($id_factura) ) {
            $temp = DB::update("UPDATE facturas_servicio SET pagado = 1 WHERE id_factura = ".$id_factura);
            return 1;
        } else {
            return 0;
        }
    }

    public static function addFactura() {
        $servicio = Request::input('servicio');
        $valor = Request::input('valor');
        $vencimiento_1 = Request::input('vencimiento_1');
        $vencimiento_2 = Request::input('vencimiento_2') == '' ? "NULL" : "'".Request::input('vencimiento_2')."'";
        $valor_mora = Request::input('valor_mora') == '' ? "NULL" : Request::input('valor_mora');

        if ( !empty($servicio) ) {
            // Insert en DDBB
            $temp = DB::insert("INSERT into facturas_servicio (id_servicio,monto,vencimiento,segundo_vencimiento,monto_mora) VALUES(".$servicio.",".$valor.",'".$vencimiento_1."',".$vencimiento_2.",".$valor_mora.")");
            return 1;
        }

    }
}