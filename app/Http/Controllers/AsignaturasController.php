<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Grado;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AsignaturasController extends Controller
{
    public function show()
    {
        return $this->index();
    }
    public function sinauto()
    {
        flash("Error #0000008: el elemento no se encuentra o no tienes autorización para realizar esta acción")->error()->important();
        return $this->index();
    }
    public function index($id)
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items         = Asignatura::where('idgrado', $id)->where('eliminado', '=', 0)->orderBy('orden')->get();

        $grado = Grado::find($id);
        if ($grado->idinstitucion != $idinstitucion) {
            sinauto();
        }
        $grados=Grado::where("idinstitucion",$idinstitucion)->get();
        $profesores = Rol::where('idinstitucion', $idinstitucion)->where('rol', 3)->get();
        return view('admin.asignaturas.index')->with('asignaturas', $items)->with('grado', $grado)->with('profesores', $profesores)->with('grados',$grados);
    }
    public function create($idgrado = 0)
    {
        //dd($idgrado);
        $grado = Grado::with("nivel")->find($idgrado);
        if (!$grado || $grado->nivel->idinstitucion != Auth::User()->idinstitucion) {
            return $this->sinauto();
        } else {
            return view('admin.asignaturas.nuevo')->with('grado', $grado)->with('nivel', $grado->nivel);
        }
    }
    public function store(Request $request, $id)
    {

        $rules = [
            'nombre' => 'required',
            'corto'  => 'required',
            'idrol'  => 'required', //'required|unique:posts|max:255|min:5|email'
            'orden'  => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre de la materia es requerido',
            'corto.required'  => 'La abreviatura de la materia es requerido',
            'idrol.required'  => 'El docente encargado de la materia es requerido',
        ];
        $this->validate($request, $rules, $messages);

        $item                                                 = new Asignatura($request->all());
        $item->idgrado                                        = $id;
        $item->estado                                         = 1;
        $item->eliminado=0;
        (is_null($request->bloqueunico)) ? $item->bloqueunico = 0 : $item->bloqueunico = 1;
        $item->save();
        Flash::success("La materia " . $item->nombre . " se ha creado exitosamente")->important();
        return redirect()->route('asignaturas.index', $id);
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Asignatura::find($id);
        $grado         = Grado::find($item->idgrado);
        if (!$item || $grado->idinstitucion != $idinstitucion) {
            sinauto();
        }
        $item->eliminado = 1;
        $item->save();
        flash("La asignatura " . $item->nombre . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('asignaturas.index', $grado->idgrado);
    }
    public function edit($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Asignatura::find($id);
        $grado         = Grado::find($item->idgrado);
        if (!$item || $grado->idinstitucion != $idinstitucion) {
            sinauto();
        }
        $profesores = Rol::where('idinstitucion', $idinstitucion)->where('rol', 3)->get();
        return view('admin.asignaturas.editar')->with('asignatura', $item)->with("profesores", $profesores);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required',
            'corto'  => 'required',
            'idrol'  => 'required', //'required|unique:posts|max:255|min:5|email'
            'orden'  => 'required',
            'estado' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre de la materia es requerido',
            'corto.required'  => 'La abreviatura de la materia es requerido',
            'idrol.required'  => 'El docente encargado de la materia es requerido',
            'estado.required' => 'El estado de la materia es requerido',
        ];
        $this->validate($request, $rules, $messages);
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Asignatura::find($id);
        $grado         = Grado::find($item->idgrado);
        if (!$item || $grado->idinstitucion != $idinstitucion) {
            sinauto();
        }

        $item->nombre      = $request->nombre;
        $item->corto       = $request->corto;
        $item->orden       = $request->orden;
        $item->estado      = $request->estado;
        $item->bloqueunico = (is_null($request->bloqueunico)) ? 0 : 1;
        $item->idrol       = $request->idrol;
        $item->save();
        Flash::success("La asignatura " . $item->nombre . " se ha editado exitosamente");
        return redirect()->route('asignaturas.index', $grado->idgrado);
    }
}
