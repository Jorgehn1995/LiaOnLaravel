<?php

namespace App\Http\Controllers;

use App\Administrador;
use App\Institucion;
use App\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class InstitucionesController extends Controller
{
    public function registrar(Request $request)
    {
        dd($request->all());
    }
    public function index()
    {
        $institucion = Auth::User()->institucion;
        return view('admin.instituciones.index')->with('institucion', $institucion);
    }
    public function show()
    {

    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        $rules = [
            'correo'      => 'required |unique:usuarios',
            'nombre'      => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido'    => 'required',
            'genero'      => 'required',
            'nacimiento'  => 'required',
            'institucion' => 'required',
            'abr'         => 'required',
            'direccion'   => 'required',
            'tel'         => 'required',
            'pass'        => 'required | min:6 | confirmed',
        ];
        $messages = [
            'correo.unique'  => 'El correo ya se encuentra en uso',
            'pass.required'  => 'Debes agregar una contraseña para tu cuenta',
            'pass.min'       => 'La contraseña debe contener al menos :min caracteres',
            'pass.confirmed' => 'El campo Contraseña y Repetir Contraseña no coinciden',
        ];
        $this->validate($request, $rules, $messages);
        /**
         * Se registra la institucion y luego el usuario
         */
        $institucion            = new Institucion();
        $institucion->nombre    = $request->institucion;
        $institucion->abr       = $request->abr;
        $institucion->direccion = $request->direccion;
        $institucion->telefono  = $request->tel;
        $institucion->correo    = $request->correo;
        $institucion->bloque    = 1;
        $institucion->url       = "plataforma.it";
        $institucion->save();

        /**
         * Se registra el usuario
         */
        $usuario                = new User($request->all());
        $usuario->usuario       = $request->correo;
        $usuario->password      = bcrypt($request->pass);
        $usuario->idtipousuario = 2;
        $usuario->idinstitucion = $institucion->idinstitucion;
        $usuario->save();

        /**
         * Se registran los roles
         */
        $admin                = new administrador();
        $admin->idusuario     = $usuario->idusuario;
        $admin->idinstitucion = $institucion->idinstitucion;
        $admin->admin         = 1;
        $admin->save();
        flash::success('Usuario Registrado exitosamente, Ingresa con tu usuario y contraseña');
        return redirect()->route('login');

    }
    public function edit($id)
    {

    }
    public function update(Request $request, $id)
    {
        $institucion=Institucion::find($id);
        if(!$institucion || $institucion->idinstitucion!=Auth::User()->idinstitucion){
            Flash::danger("error al encontrar la institucion")->important();
            return redirect()->route('admin.index');
        }
        $institucion->nombre=$request->nombre;
        $institucion->abr=$request->abr;
        $institucion->lema=$request->lema;
        $institucion->direccion=$request->direccion;
        $institucion->telefono=$request->telefono;
        $institucion->correo=$request->correo;
        $institucion->save();
        Flash::Success("Información Actualizada")->important();
        return redirect()->route('institucion.index');
    }
    public function destroy()
    {

    }
    public function logo(Request $request, $id)
    {
        $institucion = Institucion::find($id);
        if (!$institucion || $institucion->idinstitucion != Auth::User()->idinstitucion) {
            return response()->json('error', 400);
        }

        $image     = $request->file('file');
        $imageName = time() . $institucion->idinstitucion . "." . $image->getClientOriginalExtension();
        if ($institucion->logo != "") {
            unlink(public_path('images/users') . "/" . $institucion->logo);
        }
        $institucion->logo = $imageName;
        $institucion->save();
        $upload_success = $image->move(public_path('images/users'), $imageName);
        if ($upload_success) {
            return asset('images/users') . "/" . $institucion->logo;
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
}
