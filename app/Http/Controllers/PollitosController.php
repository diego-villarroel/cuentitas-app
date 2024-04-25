<?php

namespace App\Http\Controllers;
use Request;
use DB;
use Session;
use App\Http\Controllers\PlazosFijosController;
use App\Http\Controllers\CaucionesController;
use App\Http\Controllers\TarjetasController;
use App\Http\Controllers\ServiciosController;

class PollitosController extends Controller
{
    public static function loginVista(){
        // dd(Session::all());
        return view('/login/login');
    }

    public static function logearse(){
        $email = Request::input('email');
        $pass = Request::input('contraseña');
        $logeado = DB::select("SELECT * from pollitos WHERE email = '".$email."'");
        if (!empty($logeado)) {
            foreach( $logeado as $k => $persona) {
                if ($persona->pass != $pass){
                    unset($logeado[$k]);
                }
            }
            if (count($logeado) == 1) {
                $logeado = $logeado[0];
                $log_date = new \DateTime();
                $user_data = [];
                $user_data['email'] = $logeado->email;
                $user_data['user_id'] = $logeado->id_pollito;
                $user_data['nombre'] = $logeado->nombre;
                $user_data['apellido'] = $logeado->apellido;
                Session::put('usuario',$user_data);
                DB::update("UPDATE pollitos SET login = 1, login_date = '".$log_date->format('Y-m-d H:i:s')."' WHERE id_pollito = ".$logeado->id_pollito);
                return 1;
            } else {
                return 2;
            }
        } else {
            return 0;
        }
    }

    public static function cerrarSesion() {
        $usuario = Session::get('usuario');
        Session::flush();
        $log_date = new \DateTime();
        DB::update("UPDATE pollitos SET login = 0, login_date = '".$log_date->format('Y-m-d H:i:s')."' WHERE id_pollito = ".$usuario['user_id']);

        return redirect('/');
    }
}