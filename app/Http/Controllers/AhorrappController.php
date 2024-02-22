<?php

namespace App\Http\Controllers;
use Request;
use DB;
use App\Http\Controllers\PlazosFijosController;
use App\Http\Controllers\CaucionesController;

class AhorrappController extends Controller
{
    public static function inicioVista(){
        $lista_bancos = DB::select("SELECT * from bancos");
        $lista_personas = DB::select("SELECT * from pollitos");
        $lista_tipos_pf = DB::select("SELECT * from tipo_plazo_fijo");
        $lista_tarjetas = DB::select("SELECT * from tarjetas");
        $resumen_pf = PlazosFijosController::dataResumenPlazoFijo();
        $resumen_cau = CaucionesController::dataResumenCauciones();
        return view('inicio', ['resumen_pf' => $resumen_pf,'resumen_cau' => $resumen_cau,'lista_bancos' => $lista_bancos,'lista_personas' => $lista_personas,'lista_tarjetas' => $lista_tarjetas,'tipos_pf' => $lista_tipos_pf]);
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
        return view('servicios');
    }

    public static function tarjetasVista(){

        $lista_tarjetas = DB::select("SELECT * from tarjetas");
        return view('tarjetas',['lista_tarjetas' => $lista_tarjetas]);
    }
}