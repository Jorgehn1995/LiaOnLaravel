<?php

namespace App\Http\Controllers;
use App\TipoUsuario;
use App\User;
use App\Institucion;
use App\Administrador;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

class InstitucionesController extends Controller
{
    public function registrar(Request $request){
        dd($request->all());
    }
    public function index(){

    }
    public function show(){

    }
    public function create(){

    }
    public function store(Request $request){
        $rules = [
            'correo' => 'required |unique:usuarios',
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido' => 'required',
            'genero' => 'required',
            'nacimiento' => 'required',
            'institucion' => 'required',
            'abr' => 'required',
            'direccion' => 'required',
            'tel' => 'required',
            'pass' => 'required | min:6 | confirmed',
        ];
        $messages = [
            'correo.unique'=>'El correo ya se encuentra en uso',
            'pass.required' => 'Debes agregar una contraseña para tu cuenta',
            'pass.min' => 'La contraseña debe contener al menos :min caracteres',
            'pass.confirmed' =>'El campo Contraseña y Repetir Contraseña no coinciden',
        ];
        $this->validate($request, $rules, $messages);
        /**
         * Se registra la institucion y luego el usuario
         */
        $institucion = new Institucion();
        $institucion->nombre=$request->institucion;
        $institucion->abr=$request->abr;
        $institucion->direccion=$request->direccion;
        $institucion->telefono=$request->tel;
        $institucion->correo=$request->correo;
        $institucion->bloque=1;
        $institucion->url="plataforma.it";
        $institucion->save();

        /** 
         * Se registra el usuario
         */
        $usuario = new User($request->all());
        $usuario->usuario=$request->correo;
        $usuario->password = bcrypt($request->pass);
        $usuario->idtipousuario=2;
        $usuario->idinstitucion=$institucion->idinstitucion;
        $usuario->save();

        /**
         * Se registran los roles
         */
        $admin = new administrador();
        $admin->idusuario=$usuario->idusuario;
        $admin->idinstitucion=$institucion->idinstitucion;
        $admin->admin=1;
        $admin->save();
        flash::success('Usuario Registrado exitosamente, Ingresa con tu usuario y contraseña');
        return redirect()->route('login');
        
    }
    public function update(){

    }
    public function destroy(){

    }
}
