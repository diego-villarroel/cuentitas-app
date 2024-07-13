<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Login
{
    public function handle(Request $request, Closure $next){
        $sesion = (Session::all());
        $email = $request->email;
        if( isset($sesion['usuario']) && !empty($sesion['usuario']) ) {
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
}