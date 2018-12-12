<?php

namespace App\Http\Controllers;

use App\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Laracasts\Flash\Flash;

class AdministradoresController extends Controller
{
    public function perfil()
    {
        return view('admin.administradores.perfil')->with('perfil', Auth::User());
    }
    public function perfilupdate(Request $request)
    {
        $rules = [
            'correo'   => 'required',
            'nombre'   => 'required',
            'apellido' => 'required', //'required|unique:posts|max:255|min:5|email'
        ];
        $messages = [
            'correo.required'   => 'El correo requerido',
            'nombre.required'   => 'Es necesario especificar un nombre',
            'apellido.required' => 'Es necesario especificar un apellido',
        ];
        $this->validate($request, $rules, $messages);
        $comprobar = User::where('usuario', $request->correo)->where('correo', $request->correo)->where('idusuario', '!=', Auth::User()->idusuario)->count();
        if ($comprobar > 0) {
            Flash::error("El correo ya pertenece a otro usuario");
            return redirect()->route('admin.perfil');
        }
        $usuario           = User::find(Auth::User()->idusuario);
        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->usuario  = $request->correo;
        $usuario->correo   = $request->correo;
        $usuario->save();
        Flash::info("Información Actualizada")->important();
        return redirect()->route('admin.perfil');
    }
    public function changepassword(Request $request)
    {
        $rules = [
            'actual'  => 'required',
            'nueva'   => 'required',
            'repetir' => 'required', //'required|unique:posts|max:255|min:5|email'
        ];
        $messages = [
            'actual.required'  => 'La contraseña actual es requerida',
            'nueva.required'   => 'La contraseña nueva es requerida',
            'repetir.required' => 'repetir la contraseña es requerido',
        ];
        $this->validate($request, $rules, $messages);
        $usuario = User::find(Auth::User()->idusuario);
        if (Hash::check($request->actual, $usuario->password)) {
            $usuario->password   = bcrypt($request->nueva);
            $usuario->save();
            Flash::info("Contraseña Actualizada")->important();
            return redirect()->route('admin.perfil');
        }else{
            Flash::error("La contraseña actual no es correcta");
            return redirect()->route('admin.perfil');
        }

        
    }
    public function updatefoto(Request $request){
        $usuario = User::find(Auth::User()->idusuario); 
        $image     = $request->file('file');
        $imageName = time() . $usuario->idusuario . "." . $image->getClientOriginalExtension();
        if ($usuario->foto != "") {
            unlink(public_path('images/users') . "/" . $usuario->foto);
        }
        $usuario->foto = $imageName;
        $usuario->save();
        $upload_success = $image->move(public_path('images/users'), $imageName);
        if ($upload_success) {
            return asset('images/users') . "/" . $usuario->foto;
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
    public function index()
    {
        $admin = Rol::where('idinstitucion', Auth::User()->idinstitucion)->where('rol', 2)->get();
        return view('admin.administradores.index')->with('administradores', $admin);
    }
}
