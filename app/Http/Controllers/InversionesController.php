<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;
use Request;
use DB;

class InversionesController extends Controller
{
    public static function dataInversiones(){        
        $tipo_inversiones = DB::select('SELECT * FROM tipo_inversion');
        $total_valor_inversiones = 0;
        $cantidad_inv = 0;
        foreach ( $tipo_inversiones as $k => $t_inv) {
            $monto_inversion_total = 0;
            $t_inv->data_inversiones = DB::select('SELECT * FROM inversiones WHERE tipo_inversion = '.$t_inv->id_tipo_inversion);
            if ( empty($t_inv->data_inversiones)) {
                unset($tipo_inversiones[$k]);
            } else {
                foreach ( $t_inv->data_inversiones as $inv) {
                    if ($inv->activo == '1') {
                        $monto_inversion_total += $inv->valor_neto;
                        $total_valor_inversiones += $inv->valor_neto;
                        $cantidad_inv++;
                    }
                }
                $t_inv->total_inversion = $monto_inversion_total;
                $t_inv->total_inversion_string = HelperController::parsearValor($monto_inversion_total,'$');
            }
        }
        $valor_total_string = HelperController::parsearValor($total_valor_inversiones,'$');
        return [$total_valor_inversiones,array_values($tipo_inversiones),$cantidad_inv,$valor_total_string];
    }

    public static function addInversion(){
        $nombre_inversion = Request::input('nombre_inversion');
        $tipo_inversion = Request::input('tipo_inv');
        $valor_total = Request::input('valor_total');
        $persona = Request::input('persona');
        $cantidad = Request::input('cantidad');
        $empresa = !empty(Request::input('empresa')) ? '"'.Request::input('empresa').'"' : NULL;
        $descripcion = Request::input('descripcion');

        if ( !empty($nombre_inversion) && !empty($tipo_inversion) && !empty($valor_total) && !empty($persona) && !empty($cantidad) ) {

            $fecha_compra = new \DateTime();
            $fecha_compra = $fecha_compra->format('Y-m-d H:i:s');
            $valor_unidad = $valor_total/$cantidad;
            $valor_neto_string = HelperController::parsearValor($valor_total,'$');
            $valor_unidad_string = HelperController::parsearValor($valor_unidad,'$');

            DB::insert('INSERT INTO inversiones (nombre_inversion,tipo_inversion,empresa,unidad,valor_unidad,fecha_compra,valor_neto,propietario,valor_neto_string,valor_unidad_string) VALUES ("'.$nombre_inversion.'",'.$tipo_inversion.','.$empresa.','.$cantidad.','.$valor_unidad.',"'.$fecha_compra.'",'.$valor_total.','.$persona.',"'.$valor_neto_string.'","'.$valor_unidad_string.'")');

            return 1;
        } else {
            return 0;
        }
    }

    public static function borrarInversion(){
        $id_inv = Request::input('id_inversion');
        if ( !empty($id_inv) ) {
            $temp = DB::delete("DELETE FROM inversiones WHERE id_inversion = ".$id_inv);
            return 1;
        } else {
            return 0;
        }
    }

    public static function venderInversion(){
        $id_inv = Request::input('id_inversion');
        $cantidad = Request::input('cantidad');
        $valor_total = Request::input('valor_total');
        if ( !empty($id_inv) ) {
            $aux = DB::selectOne("SELECT * FROM inversiones WHERE id_inversion = ".$id_inv);
            if ($aux->activo == 1 && $aux->unidad > 0 && $aux->unidad >= $cantidad ) {
                $cantidad = $aux->unidad - $cantidad;
                $valor_unidad = $valor_total / $cantidad;
            } else {
                return 0;
            }
            $temp = DB::update("UPDATE inversiones SET activo = 0 WHERE id_inversion = ".$id_inv);
            return 1;
        } else {
            return 0;
        }
    }
}