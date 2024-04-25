<?php

namespace App\Http\Controllers;
use Request;
use DB;

class HelperController extends Controller
{
    public static function validarMonto($valor){
        $validate = is_numeric($valor) ? 1 : 0;
        return $validate;
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