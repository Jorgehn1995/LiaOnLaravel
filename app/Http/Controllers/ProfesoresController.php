<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\ProfesoresRequest;

use App\TipoUsuario;
use App\User;
use Laracasts\Flash\Flash;
class ProfesoresController extends Controller
{
    public function index(){
        $idinstitucion = Auth::User()->idinstitucion;
        $usuarios = User::where('idinstitucion', '=', "$idinstitucion")
        ->where('idtipousuario', '=', "3")
        ->orderBy('idusuario', 'DESC')->paginate(10);
        $usuarios->each(function ($usuarios) {
            $usuarios->tipo;
        });

        return view('admin.profesores.index')->with('usuarios', $usuarios);
    }
    public function create()
    {
        $tipousuario = TipoUsuario::all();
        return view('admin.profesores.nuevo')->with('tipousuario', $tipousuario);
    }
    public function store(ProfesoresRequest $request)
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->idtipousuario=3;
        $usuario->idinstitucion=$idinstitucion;
        $usuario->save();
        Flash::success("El profesor " . $usuario->nombre . " " . $usuario->apellido . " ha sido registrado exitosamente")->important();
        return redirect()->route('profesores.index');
    }
    public function destroy($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            flash("Error, el elemento a eliminar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        };
        if ($usuario->idinstitucion != Auth::User()->idinstitucion) {
            flash("No tienes autorizacion para eliminar este usuario")->error()->important();
            return redirect()->route('profesores.index');
        }
        $usuario->delete($id);
        flash("El usuario " . $usuario->nombre . " " . $usuario->apellido . " ha sido borrado de forma exitosa")->error()->important();
        return redirect()->route('profesores.index');
    }
    public function edit($id){
        $usuario = User::find($id);
        if (!$usuario) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        };
        if ($usuario->idinstitucion != Auth::User()->idinstitucion) {
            flash("No tienes autorizacion para editar este usuario")->error()->important();
            return redirect()->route('profesores.index');
        }
        return view('admin.profesores.editar')->with('usuario', $usuario);
    }
    public function update(Request $request,$id){
        $request->validate([
            'nombre'=>'min:3|max:120|required',  //'required|unique:posts|max:255|min:5|email'
            'apellido'=>'min:4|max:120|required',
            'genero'=>'max:1|required',
        ]);
        $usuario = User::findOrFail($id);
        if (!$usuario) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('profesores.index');
        };
        if ($usuario->idinstitucion != Auth::User()->idinstitucion) {
            flash("No tienes autorizacion para editar este usuario")->error()->important();
            return redirect()->route('profesores.index');
        }
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->genero = $request->genero;
        $usuario->nacimiento = $request->nacimiento;
        $usuario->direccion = $request->direccion;
        $usuario->telefono = $request->telefono;
        $usuario->correo = $request->correo;
        $usuario->usuario = $request->usuario;
        $usuario->save();
        flash("El usuario " . $usuario->nombre . " " . $usuario->apellido . " ha sido modificado de forma exitosa")->success()->important();
        return redirect()->route('profesores.index');

    }
    public function show($id){
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
