<?php

namespace App\Http\Controllers;
use Request;
use DB;

class PresupuestoController extends Controller
{
    public static function dataPresupuestos(){
        $data_presupuestos = DB::select('SELECT * FROM presupuestos');
        $total_monto = 0;
        $total_gastado = 0;
        foreach ( $data_presupuestos as $presu) {
            $total_monto += $presu->monto_presupuesto;
            $total_gastado += $presu->gastado_presupuesto;
        }
        $data_presupuestos = array(
            'total_monto' => HelperController::parsearValor($total_monto,'$'),
            'total_gastado' => HelperController::parsearValor($total_gastado,'$'),
        );
        $data_presupuestos = (object)$data_presupuestos;
        return $data_presupuestos;
    }
    public static function addTipoPresu(){
        $tipo_presu = Request::input('tipo_presu');
        $icono = Request::input('icono');
        if ( !is_null($tipo_presu) && !empty($tipo_presu) ) {
            $todos_tipos_presu = DB::select('SELECT * from tipo_presupuestos');
            foreach ( $todos_tipos_presu as $tipos) {
                if ( str_contains($tipos->nombre_tipo_presupuesto, $tipo_presu) ){
                    return 2;
                }
            }
            DB::insert('INSERT INTO tipo_presupuestos (nombre_tipo_presupuesto, icono) VALUES ("'.$tipo_presu.'","'.$icono.'")');
            return 1;
        } else {
            return 0;
        }
    }

    public static function addPresupuesto(){
        $tipo_presu = Request::input('tipo_presupuesto');
        $mes = Request::input('mes');
        $mes_string = Request::input('mes_string');
        $monto = Request::input('valor');
        $nombre = Request::input('nombre');
        if ( !is_null($tipo_presu) && !empty($tipo_presu) && !is_null($mes) && !empty($mes) && !is_null($mes_string) && !empty($mes_string) && !is_null($monto) && !empty($monto) ) {
            $monto_string = HelperController::parsearValor($monto,'$');
            DB::insert('INSERT INTO presupuestos (nombre_presupuesto, id_tipo_presupuesto, monto_presupuesto, mes, string_monto_presupuesto, string_mes) VALUES ("'.$nombre.'",'.$tipo_presu.','.$monto.','.$mes.',"'.$monto_string.'","'.$mes_string.'")');
            return 1;
        } else {
            return 0;
        }
    }

    public static function borrarPresupuesto(){
        $id_presupuesto = Request::input('id');
        $accion = Request::input('accion');

        if (!is_null($id_presupuesto) && !empty($id_presupuesto) && $accion == 'del_presu') {
            $existe = DB::select('SELECT id_presupuesto FROM presupuestos WHERE id_presupuesto = '.$id_presupuesto);
            $gastos = DB::select('SELECT id_gasto FROM gastos_presupuesto WHERE id_presupuesto = '.$id_presupuesto);

            if ( count($gastos) > 0 ) {
                DB::delete('DELETE FROM gastos_presupuesto WHERE id_presupuesto = '.$id_presupuesto);
            }
            if ( count($existe) > 0 ) {
                DB::delete('DELETE FROM presupuestos WHERE id_presupuesto = '.$id_presupuesto);
                return 1;
            }
        }
        return 0;
    }

    public static function gastoPresupuesto(){
        $presu = !empty(Request::input('id_presu_select')) ? Request::input('id_presu_select') : Request::input('presu_gasto');
        $monto = Request::input('valor');
        $nombre = Request::input('nombre');
        if ( !is_null($presu) && !empty($presu) && !is_null($monto) && !empty($monto) ) {
            $monto_string = HelperController::parsearValor($monto,'$');
            $presu_data = DB::select('SELECT gastado_presupuesto FROM presupuestos WHERE id_presupuesto = '.$presu);
            $total_gastado = $presu_data[0]->gastado_presupuesto + $monto;
            $gastado_string = HelperController::parsearValor($monto,'$');
            DB::insert('INSERT INTO gastos_presupuesto (nombre_gasto, id_presupuesto, monto, string_monto) VALUES ("'.$nombre.'",'.$presu.','.$monto.',"'.$monto_string.'")');
            DB::update('UPDATE presupuestos SET gastado_presupuesto = '.$total_gastado.' WHERE id_presupuesto = '.$presu);
            DB::update('UPDATE presupuestos SET string_gastado_presupuesto = '.$gastado_string.' WHERE id_presupuesto = '.$presu);
            return 1;
        } else {
            return 0;
        }
    }

    public static function borrarGastoPresupuesto(){
        $id_gasto = Request::input('id');
        $accion = Request::input('accion');
        
        if (!is_null($id_gasto) && !empty($id_gasto) && $accion == 'del_gasto') {
            $existe = DB::select('SELECT g.id_gasto,g.id_presupuesto,g.monto,p.gastado_presupuesto FROM gastos_presupuesto AS g INNER JOIN presupuestos as p ON g.id_presupuesto = p.id_presupuesto WHERE id_gasto = '.$id_gasto);
            
            if ( count($existe) > 0 ) {
                $id_presu = $existe[0]->id_presupuesto;
                $gastado_presupuesto = $existe[0]->gastado_presupuesto;
                $gastado  = $existe[0]->monto;

                $gastado = $gastado_presupuesto - $gastado;
                $gastado = $gastado < 0 ? 0 : $gastado;

                $gastado_string = HelperController::parsearValor($gastado,'$');
                DB::update('UPDATE presupuestos SET gastado_presupuesto = '.$gastado.' WHERE id_presupuesto = '.$id_presu);
                DB::update('UPDATE presupuestos SET string_gastado_presupuesto = "'.$gastado_string.'" WHERE id_presupuesto = '.$id_presu);
                // 
                DB::delete('DELETE FROM gastos_presupuesto WHERE id_gasto = '.$id_gasto);
                return 1;
            } else {
                return 2;
            }
        }
        return 0;
    }
}