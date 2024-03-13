<?php

namespace App\Http\Controllers;
use Request;
use DB;

class AhorrappController extends Controller
{
    public static function inicioVista(){
        return view('inicio');
    }

    public static function caucionesVista(){
        return view('cauciones');
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