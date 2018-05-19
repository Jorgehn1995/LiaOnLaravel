<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class LoginController extends Controller
{
    public function index()
    {
        //dd(Auth::User());
        return view('login');
    }
    public function authlogin(Request $request)
    {
        //dd($request->all());
        $credentials = $request->only('usuario', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            if ($user->idtipousuario == 1) {
                return redirect('master');
            }
            if ($user->idtipousuario == 2) {
                return redirect('admin');
            }
        } else {
            flash("Usuario o Contraseña Invalido")->error();

            return view('login');
        }
    }
    public function logout()
    {
        Auth::logout();
        flash("Sesión Finalizada")->success();
        return view('login');
    }
    public function check()
    {
        if (Auth::check()) {
            $usuario=Auth::User();
            
            if($usuario->idtipousuario==2){
                return redirect('admin');
            }
        }else {
            
            return redirect('login');
        }

    }
}
