<?php

namespace App\Http\Controllers;
use Request;
use DB;

class UsuariosController extends Controller
{
    public static function vistaLogin(){
        // dd($_SERVER);
        $lugar = $_SERVER['REQUEST_URI'];
        return view('usuario/login',['lugar' => $lugar]);
    }
    
    public static function login(){
        $email = Request::input('email');
        $pass = Request::input('pass');
        // 
        $login_data = DB::select("SELECT * FROM Usuarios WHERE email_usuario = '".$email."' AND clave_usuario = '".$pass."'");        
        if (!empty($login_data)) {
            $temp = DB::update("UPDATE Usuarios SET estado_login = 1 WHERE id_usuario = ".$login_data[0]->id_usuario);
            $login_data = DB::select("SELECT id_usuario,nombre,apellido,email_usuario,estado_login FROM Usuarios WHERE email_usuario = '".$email."' AND clave_usuario = '".$pass."'");
            // 
            // return json_encode($login_data);
            return view('/usuario/login',[ 'login_data' => $login_data]);
        } else {
            return 0;
        }
    }
}