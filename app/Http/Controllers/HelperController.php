<?php

namespace App\Http\Controllers;
use Request;

class HelperController extends Controller
{
    public static function validarMonto($valor){
        $validate = is_numeric($valor) ? 1 : 0;
        return $validate;
    }
    
    public static function parsearValor($valor,$tipo_parse) {
        $valor = ''.$valor == '0' ? '0.00' : ''.$valor;
        if ($tipo_parse == '$') {
            $valor_string = explode('.',strval($valor))[0];
            if (strlen($valor_string) > 3 && strlen($valor_string) < 7) {
                $miles = strlen($valor_string) - 3;
                $valor_string = substr($valor_string, 0, $miles).'.'.substr($valor_string, -3);
            }
            if (strlen($valor_string) > 7 && strlen($valor_string) < 9) {
                $millones = strlen($valor_string) - 6;
                $valor_string = substr($valor_string, 0, $millones).'.'.substr($valor_string, -6, -4).'.'.substr($valor_string, -3);
            }
            if (isset(explode('.',strval($valor))[1])) {
                $valor_string .= ','.substr(explode('.',strval($valor))[1],0,2);
            } else {
                $valor_string .= ',00';
            }

        } elseif ($tipo_parse == '%') {
            $aux = explode('.',$valor);
            $valor_string = $aux[0];
            if ( isset($aux[1]) ) {
                if ( strlen($aux[1]) > 2 ) {
                    $valor_string .= '.'.substr(explode('.',strval($valor))[1],0,2);
                } else {
                    $valor_string .= '.'.explode('.',strval($valor))[1];                
                }
            }            
        }
        return $valor_string;

    }
}