<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\Rol;
use App\User;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function index()
    {
        return view('register');

    }
    public function store(Request $request)
    {
        $rules = [
            'correo'      => 'required |unique:usuarios,usuario|unique:usuarios,correo',
            'nombre'      => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido'    => 'required',
            'pass'        => 'required | min:6 | confirmed',
            'institucion' => 'required',
            'abr'         => 'required',
            'direccion'   => 'required',
            'tel'         => 'required',
        ];
        $messages = [
            'correo.unique'  => 'El correo ya se encuentra registrado',
            'pass.required'  => 'Debes agregar una contraseña para tu cuenta',
            'pass.min'       => 'La contraseña debe contener al menos :min caracteres',
            'pass.confirmed' => 'El campo Contraseña y Repetir Contraseña no coinciden',
        ];
        $this->validate($request, $rules, $messages);
        //return $request->all();

        /**
         * Se registra el colegio con los datos proporcionados
         */

        $colegio = new Institucion();
        $colegio->nombre = $request->institucion;
        $colegio->abr = $request->abr;
        $colegio->direccion = $request->direccion;
        $colegio->telefono = $request->tel;
        $colegio->save();


        /**
         * Se Registra el usuario con los datos proporcionados
         */

        $usuario           = new User();
        $usuario->usuario  = $request->correo;
        $usuario->correo   = $request->correo;
        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->password = bcrypt($request->pass);
        $usuario->idinstitucion=$colegio->idinstitucion;
        $usuario->idtipousuario=2;
        $usuario->save();
        

        /**
         * Se registra el rol con los datos proporcionados
         */

        $rol                = new Rol();
        $rol->idusuario     = $usuario->idusuario;
        $rol->idinstitucion = $colegio->idinstitucion;
        $rol->rol           = 2;
        $rol->save();

        $return['usuario'] = $usuario;
        $return['colegio'] = $colegio;
        $return['rol']     = $rol;
        return $return;

    }
}
