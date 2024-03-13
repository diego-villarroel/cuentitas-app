<?php

namespace App\Http\Controllers;
use Request;
use DB;
use App\Http\Controllers\PlazosFijosController;
use App\Http\Controllers\CaucionesController;
use App\Http\Controllers\TarjetasController;
use App\Http\Controllers\ServiciosController;

class AhorrappController extends Controller
{
    public static function inicioVista(){
        $lista_bancos = DB::select("SELECT * from bancos");
        $lista_personas = DB::select("SELECT * from pollitos");
        $lista_tipos_pf = DB::select("SELECT * from tipo_plazo_fijo");
        $lista_tarjetas = DB::select("SELECT * from tarjetas");
        $lista_servicios = DB::select("SELECT * from servicios");
        $resumen_pf = PlazosFijosController::dataResumenPlazoFijo();
        $resumen_cau = CaucionesController::dataResumenCauciones();
        $resumen_tarjetas = TarjetasController::dataResumenTarjetas();
        $data_facturas = ServiciosController::dataFacturas();
        return view('inicio', ['resumen_pf' => $resumen_pf,'resumen_cau' => $resumen_cau,'lista_bancos' => $lista_bancos,'lista_personas' => $lista_personas,'lista_tarjetas' => $lista_tarjetas,'tipos_pf' => $lista_tipos_pf,'resumen_tarjetas' => $resumen_tarjetas,'lista_servicios' => $lista_servicios,'data_facturas' => $data_facturas]);
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
        return view('inversiones');
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
        foreach ($lista_tarjetas as $tarjetas) {
            $nombres[$tarjetas->id_tarjeta] = $tarjetas->nombre_tarjeta;
            $resumenes_tarjetas = [];
            foreach ($data_tarjetas->data_completa as $resumen) {
                if ($resumen->id_tarjeta == $tarjetas->id_tarjeta) {
                    array_push($resumenes_tarjetas,$resumen);
                }
            }
            $resumenes[$tarjetas->id_tarjeta] = $resumenes_tarjetas;
        }
        $lista_resumen_tarjetas->nombres_tarjetas = $nombres;
        $lista_resumen_tarjetas->resumenes_tarjetas = $resumenes;
        return view('tarjetas',['lista_tarjetas' => $lista_tarjetas,'data_tarjetas' => $data_tarjetas,'lista_personas' => $lista_personas,'lista_resumen_tarjetas' => $lista_resumen_tarjetas]);
    }
}