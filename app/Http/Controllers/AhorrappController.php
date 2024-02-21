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
        $lista_tarjetas = DB::select("SELECT * from tarjetas");
        $resumen_pf = PlazosFijosController::dataResumenPlazoFijo();
        $resumen_cau = CaucionesController::dataResumenCauciones();
        return view('inicio', ['resumen_pf' => $resumen_pf,'resumen_cau' => $resumen_cau,'lista_bancos' => $lista_bancos,'lista_personas' => $lista_personas,'lista_tarjetas' => $lista_tarjetas]);
    }

    public static function caucionesVista(){
        $resumen_cau = CaucionesController::dataResumenCauciones();
        return view('cauciones', ['resumen_cau' => $resumen_cau]);
    }

    public static function plazosFijosVista(){
        return view('plazos-fijos');
    }

    public static function inversionesVista(){
        return view('inversiones');
    }

    public static function serviciosVista(){
        return view('servicios');
    }

    public static function tarjetasVista(){
        return view('tarjetas');
    }
}