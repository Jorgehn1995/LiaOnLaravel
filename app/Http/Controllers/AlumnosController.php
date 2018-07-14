<?php

namespace App\Http\Controllers;


use App\Informacion;
use App\TipoUsuario;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
class AlumnosController extends Controller
{
    public function create(){
        return view('admin.alumnos.nuevo');
    }
    public function show($id){
        $usuario = Informacion::where("codigo","=",$id)->get();
        return($usuario);
    }
    public function store(Request $request){
        $request->validate([
            'codigo' => 'required|unique:informaciones',
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido' => 'required',
            'genero' => 'required',
            'nacimiento' => 'required',
        ]);
        //dd($request->all());
        $item = new User($request->all());
        $item->usuario=$request->codigo;
        $ps=date("Y", strtotime($request->nacimiento));
        $item->password=bcrypt($ps);
        $item->idtipousuario=4;
        $item->idinstitucion=Auth::User()->institucion->idinstitucion;
        $item->save();
        $usuario=User::where("nombre","=",$request->nombre)
        ->where("apellido","=",$request->apellido)
        ->where("nacimiento","=",$request->nacimiento)->first();
        //dd($usuario->idusuario);
        if(!$usuario){
            Flash::error("Se ha producido un error al agregar la información del alumno")->important();
            return redirect()->route('alumnos.create');
        }else{
            $info= new Informacion($request->all());
            $info->idusuario=$usuario->idusuario;
            $info->save();
            Flash::success("El alumno $request->nombre $request->apellido ha sido agregado exitosamente ")->important();
            return redirect()->route('alumnos.create');
        }
        
    }
}
