<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\TipoUsuario;
use App\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class UsuariosController extends Controller
{
    //
    public function index()
    {
        $usuarios = User::orderBy('idusuario', 'DESC')->paginate(10);
        $usuarios->each(function ($usuarios) {
            $usuarios->tipo;
        });

        return view('master.usuarios.index')->with('usuarios', $usuarios);
    }
    public function create()
    {
        $tipousuario = TipoUsuario::all();
        return view('master.usuarios.nuevo')->with('tipousuario', $tipousuario);
    }
    public function store(UsuarioRequest $request)
    {

        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        Flash::success("El usuario " . $usuario->nombre . " " . $usuario->apellido . " se ha creado exitosamente");
        return redirect()->route('usuarios.index');

    }
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete($id);
        flash("El usuario " . $usuario->nombre . " " . $usuario->apellido . " ha sido borrado de forma exitosa")->error()->important();
        return redirect()->route('usuarios.index');
    }
    public function edit($id)
    {
        $usuario = User::find($id);
        $tipousuario = TipoUsuario::all();
        return view('master.usuarios.editar')->with('usuario', $usuario)->with('tipousuario', $tipousuario);
    }
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->genero = $request->genero;
        $usuario->nacimiento = $request->nacimiento;
        $usuario->direccion = $request->direccion;
        $usuario->telefono = $request->telefono;
        $usuario->correo = $request->correo;
        $usuario->idtipousuario = $request->idtipousuario;
        $usuario->save();
        flash("El usuario " . $usuario->nombre . " " . $usuario->apellido . " ha sido modificado de forma exitosa")->success()->important();
        return redirect()->route('usuarios.index');
    }
    public function show($id)
    {
        $usuario = User::find($id);
        $tipousuario = TipoUsuario::all();
        return view('master.usuarios.mostrar')->with('usuario', $usuario)->with('tipousuario', $tipousuario);

    }

}
