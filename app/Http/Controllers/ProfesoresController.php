<?php

namespace App\Http\Controllers;

use App\Rol;
use App\TipoUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ProfesoresController extends Controller
{
    public function pass($id){
        $usuario=User::find($id);
        if(!$usuario){
            Flash::success("No hemos encontrado el codigo")->important();
            return redirect()->route('profesores.index');
        }
        $pass=date("dmY");
        $usuario->password= bcrypt($pass);
        $usuario->codigo=$pass;
        Flash::success("Se ha cambiado la contraseña de $usuario->nombre $usuario->apellido, la nueva clave es $pass")->important();
        return redirect()->route('profesores.index');
    }
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $profesores    = Rol::where('idinstitucion', '=', "$idinstitucion")
            ->where('rol', '=', "3")
            
            ->orderBy('idusuario', 'DESC')->paginate(10);

        return view('admin.profesores.index')->with('profesores', $profesores);
    }
    public function create()
    {
        $tipousuario = TipoUsuario::all();
        return view('admin.profesores.nuevo')->with('tipousuario', $tipousuario);
    }
    public function store(Request $request)
    {
        
        //dd($request->all());
        $rules = [
            'usuario'   => 'required |unique:usuarios,usuario',
            'nombre'   => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido' => 'required',
        ];
        $messages = [
            'usuario.unique'     => 'El usuario ya se encuentra registrado',
            'nombre.required'   => 'El campo nombre es obligatorio',
            'apellido.required' => 'El campo apellido es obligatorio',
        ];
        $this->validate($request, $rules, $messages);
        $password               = date("dmY");
        $usuario                = new User();
        $usuario->usuario       = $request->usuario;
        //$usuario->correo        = $request->correo;
        $usuario->nombre        = $request->nombre;
        $usuario->apellido      = $request->apellido;
        $usuario->codigo        = $password;
        $usuario->password      = bcrypt($password);
        $usuario->idinstitucion = Auth::User()->idinstitucion;
        $usuario->idtipousuario = 3;
        $usuario->save();

        $rol                = new Rol();
        $rol->idusuario     = $usuario->idusuario;
        $rol->idinstitucion = Auth::User()->idinstitucion;
        $rol->rol           = 3;
        $rol->estado        =1;
        $rol->save();

        Flash::success("El profesor " . $usuario->nombre . " " . $usuario->apellido . " ha sido registrado exitosamente, la contraseña de acceso es $password")->important();
        return redirect()->route('profesores.index');
    }
    public function destroy($id)
    {
        
        $rol = Rol::find($id);
        if (!$rol) {
            flash("Error, el elemento a eliminar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        };
        if ($rol->idinstitucion != Auth::User()->idinstitucion) {
            flash("No tienes autorizacion para eliminar este usuario")->error()->important();
            return redirect()->route('profesores.index');
        }
        if($rol->estado==1){
            $rol->estado=0;
            flash("El usuario ha sido inactivado de forma exitosa")->error()->important();
        }else{
            $rol->estado=1;
            flash("El usuario ha sido activado de forma exitosa")->success()->important();
        }
        $rol->save();
        
        return redirect()->route('profesores.index');
    }
    public function edit($id)
    {
        $usuario = Rol::where("idusuario", $id)->where("idinstitucion", Auth::User()->idinstitucion)->where("rol", 3)->first();
        if (!$usuario) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        };
        return view('admin.profesores.editar')->with('usuario', $usuario->usuario);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'correo'   => 'required ',
            'nombre'   => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido' => 'required',
        ];
        $messages = [
            'correo.unique'     => 'El correo ya se encuentra registrado',
            'nombre.required'   => 'El campo nombre es obligatorio',
            'apellido.required' => 'El campo apellido es obligatorio',
        ];
        $this->validate($request, $rules, $messages);
        $emailvalidate = User::where('correo', $request->correo)->where('idusuario', '!=', $id)->first();
        if ($emailvalidate) {
            Flash::error("El correo ya pertenece a otro usuario")->important();
            return redirect(url()->previous());
        }
        $usuario = User::findOrFail($id);
        if (!$usuario) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        }

        //$usuario->usuario  = $request->correo;
        $usuario->correo   = $request->correo;
        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->idinstitucion = Auth::User()->idinstitucion;
        $usuario->idtipousuario = 3;
        $usuario->save();
        flash("El usuario " . $usuario->nombre . " " . $usuario->apellido . " ha sido modificado de forma exitosa")->success()->important();
        return redirect()->route('profesores.index');

    }
    public function show($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        };
        if ($usuario->idinstitucion != Auth::User()->idinstitucion) {
            flash("No tienes autorizacion para editar este usuario")->error()->important();
            return redirect()->route('profesores.index');
        }
        return view('admin.profesores.mostrar')->with('usuario', $usuario);
    }
}
