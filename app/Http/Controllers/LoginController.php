<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\User;
use View;
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
        $credentials = $request->only('usuario', 'password', 'recordar');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            $name=explode(" ",Auth::User()->nombre);
            $lastname=explode(" ",Auth::User()->apellido);
            $last="";
            if(!isset($lastname[1])){
                //dd($lastname[0]);
                if ($lastname[0]=="De" ||$lastname[0]=="de"){
                    $last=$lastname[0]." ".$lastname[1];
                }else{
                    $last=$lastname[0];
                }
            }else{
                $last=$lastname[0];
            }
            $user->socialname=$name[0]." ".$last;
            $user->save();
            $this->redirectTo = url()->previous(); //LO AGREGAMOS PARA OBTENER LA URL ANTERIOR
            
            return redirect('admin');
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
            



            $usuario = Auth::User();
            $name=explode(" ",Auth::User()->nombre);
            $lastname=explode(" ",Auth::User()->apellido);
            $last="";
            if(!is_null($lastname[1])){
                //dd($lastname[0]);
                if ($lastname[0]=="De" ||$lastname[0]=="de"){
                    $last=$lastname[0]." ".$lastname[1];
                }else{
                    $last=$lastname[0];
                }
            }else{
                $last=$lastname[0];
            }
            $usuario->socialname=$name[0]." ".$last;
            $usuario->save();
        
            if ($usuario->idtipousuario == 2) {
                return redirect('admin');
            }
        } else {

            return redirect('login');
        }

    }
}
