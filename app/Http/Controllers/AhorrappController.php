<?php

namespace App\Http\Controllers;
use Request;
use DB;
use Session;
use App\Http\Controllers\PlazosFijosController;
use App\Http\Controllers\CaucionesController;
use App\Http\Controllers\TarjetasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\InversionesController;
use App\Http\Controllers\HelperController;

class AhorrappController extends Controller
{
    public static function inicioVista(){
        $lista_bancos = DB::select("SELECT * from bancos");
        $lista_personas = DB::select("SELECT * from pollitos");
        $lista_tipos_pf = DB::select("SELECT * from tipo_plazo_fijo");
        $lista_tarjetas = DB::select("SELECT * from tarjetas");
        $lista_servicios = DB::select("SELECT * from servicios");
        $tipo_presu = DB::select('SELECT * FROM tipo_presupuestos');
        $tipo_inversiones = DB::select('SELECT * FROM tipo_inversion');
        // 
        $presu = DB::select('SELECT * FROM presupuestos');
        $resumen_pf = PlazosFijosController::dataResumenPlazoFijo();
        $resumen_cau = CaucionesController::dataResumenCauciones();
        $resumen_tarjetas = TarjetasController::dataResumenTarjetas();
        $data_facturas = ServiciosController::dataFacturas();
        $data_presupuestos = PresupuestoController::dataPresupuestos();
        $data_inversiones = InversionesController::dataInversiones();
        // 
        return view('inicio', ['resumen_pf' => $resumen_pf,'resumen_cau' => $resumen_cau,'lista_bancos' => $lista_bancos,'lista_personas' => $lista_personas,'lista_tarjetas' => $lista_tarjetas,'tipos_pf' => $lista_tipos_pf,'resumen_tarjetas' => $resumen_tarjetas,'lista_servicios' => $lista_servicios,'data_facturas' => $data_facturas, 'presupuestos' => $presu, 'tipos_presupuestos' => $tipo_presu, 'data_presupuestos' => $data_presupuestos, 'tipo_inversiones' => $tipo_inversiones, 'inversiones' => $data_inversiones]);
    }

    public static function caucionesVista(){
        $lista_personas = DB::select("SELECT * from pollitos");
        $resumen_cau = CaucionesController::dataResumenCauciones();
        return view('cauciones', ['resumen_cau' => $resumen_cau,'lista_personas' => $lista_personas]);
    }

    public static function plazosFijosVista(){
        $lista_bancos = DB::select("SELECT * from bancos");
        $lista_personas = DB::select("SELECT * from pollitos");
        $lista_tipos_pf = DB::select("SELECT * from tipo_plazo_fijo");
        $resumen_pf = PlazosFijosController::dataResumenPlazoFijo();
        return view('plazos-fijos',['lista_bancos' => $lista_bancos,'tipos_pf' => $lista_tipos_pf,'lista_personas' => $lista_personas, 'resumen_pf' => $resumen_pf]);
    }

    public static function inversionesVista(){
        $tipo_inversiones = DB::select('SELECT * FROM tipo_inversion');
        $inversiones = InversionesController::dataInversiones();
        $lista_personas = DB::select("SELECT * from pollitos");
        $total_inv = HelperController::parsearValor($inversiones[0],'$');
        return view('inversiones',['tipo_inversiones' => $tipo_inversiones,'inversiones' => $inversiones[1],'total_inversiones' => $total_inv, 'lista_personas' => $lista_personas]);
    }

    public static function serviciosVista(){
        $data_facturas = ServiciosController::dataFacturas();
        $lista_servicios = DB::select("SELECT * from servicios ORDER BY nombre_servicio ASC");
        return view('servicios',['lista_servicios' => $lista_servicios,'data_facturas' => $data_facturas]);
    }

    public static function tarjetasVista(){
        $data_tarjetas = TarjetasController::dataResumenTarjetas();
        $lista_tarjetas = DB::select("SELECT * from tarjetas");
        $lista_personas = DB::select("SELECT * from pollitos");
        $lista_resumen_tarjetas = (object)[];
        $nombres = [];
        $resumenes = [];
        foreach ($lista_tarjetas as $i => $tarjetas) {
            $nombres[$tarjetas->id_tarjeta] = $tarjetas->nombre_tarjeta;
            $resumenes_tarjetas = [];
            foreach ($data_tarjetas->data_completa as $resumen) {
                if ($resumen->id_tarjeta == $tarjetas->id_tarjeta) {
                    array_push($resumenes_tarjetas,$resumen);
                    $lista_tarjetas[$i]->pagado = $resumen->pagado;
                }
            }
            $resumenes[$tarjetas->id_tarjeta] = $resumenes_tarjetas;
        }
        $lista_resumen_tarjetas->nombres_tarjetas = $nombres;
        $lista_resumen_tarjetas->resumenes_tarjetas = $resumenes;

        return view('tarjetas',['lista_tarjetas' => $lista_tarjetas,'data_tarjetas' => $data_tarjetas,'lista_personas' => $lista_personas,'lista_resumen_tarjetas' => $lista_resumen_tarjetas]);
    }

    public static function presupuestoVista() {
        $tipo_presu = DB::select('SELECT * FROM tipo_presupuestos');
        $presu = DB::select('SELECT * FROM presupuestos');
        $gastos = DB::select('SELECT g.id_gasto, g.nombre_gasto, g.string_monto, g.fecha, g.id_presupuesto, p.nombre_presupuesto, p.string_monto_presupuesto, p.string_gastado_presupuesto, p.gastado_presupuesto, p.monto_presupuesto FROM gastos_presupuesto AS g INNER JOIN presupuestos AS p ON g.id_presupuesto = p.id_presupuesto ORDER BY g.id_presupuesto, g.fecha ASC');
        $gastos_por_presu = [];
        foreach ($presu as $pr) {
            $gastos_por_presu[$pr->id_presupuesto] = [];
            $gastado_total = 0;
            foreach ($gastos as $g) {
                if ($g->id_presupuesto == $pr->id_presupuesto) {
                    $gastado_total += $g->gastado_presupuesto;
                    array_push($gastos_por_presu[$g->id_presupuesto], $g);
                } else {
                    $gastos_por_presu[$g->id_presupuesto]['GASTO_TOTAL'] = $gastado_total;
                }
            }
        }
        return view('presupuesto',[ 'tipos_presupuestos' => $tipo_presu, 'presupuestos' => $presu, 'gastos' => $gastos_por_presu ]);
    }

    public static function promocionesVista() {
        $lista_bancos = DB::select("SELECT * FROM bancos");
        $data_promos = PromocionController::dataPromociones();
        return view('promociones',['lista_bancos' => $lista_bancos, 'data_promos' => $data_promos]);
    }
}