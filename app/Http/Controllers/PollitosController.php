<?php

namespace App\Http\Controllers;
use Request;
use DB;
use Session;

class PollitosController extends Controller
{
    public static function loginVista(){
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
        if ( isset($usuario['user_id']) ) {
            DB::update("UPDATE pollitos SET login = 0, login_date = '".$log_date->format('Y-m-d H:i:s')."' WHERE id_pollito = ".$usuario['user_id']);
        }

        return redirect('/');
    }

    public static function resetVista(){
        return view('/login/restablecer');
    }

    public static function reestablecerClave(){
        return self::generarClaveTemp();
    }

    public static function generarClaveTemp(){
        // Multiple recipients
        $to = 'johny@example.com, sally@example.com'; // note the comma

        // Subject
        $subject = 'Birthday Reminders for August';

        // Message
        $message = '
        <html>
        <head>
        <title>Birthday Reminders for August</title>
        </head>
        <body>
        <p>Here are the birthdays upcoming in August!</p>
        <table>
            <tr>
            <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
            </tr>
            <tr>
            <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
            </tr>
            <tr>
            <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
            </tr>
        </table>
        </body>
        </html>
        ';

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        $headers[] = 'To: Mary <diego.n.villarroel@gmail.com>, Kelly <kelly@example.com>';
        $headers[] = 'From: Birthday Reminder <diego.n.villarroel@gmail.com>';
        $headers[] = 'Cc: birthdayarchive@example.com';
        $headers[] = 'Bcc: birthdaycheck@example.com';

        // Mail it
        return mail($to, $subject, $message, implode("\r\n", $headers));
    }

    public static function registroVista(){
        return view('/login/registro');
    }
}