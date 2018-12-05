<?php

namespace App\Http\Controllers;

use App\Asignacion;
use App\Asignatura;
use App\Grado;
use App\Nivel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AsignacionesController extends Controller
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
    public function index()
    {
        $items = Grado::where("idinstitucion",Auth::User()->idinstitucion)
            ->paginate(10);
        //dd($items);
        return view('admin.asignaciones.index')->with('grados', $items);
    }
    public function create($idgrado = 0)
    {
        $grado = Grado::with("nivel", "secciones", "asignaturas")->find($idgrado);
        if (!$grado || $grado->nivel->idinstitucion != Auth::User()->idinstitucion) {
            return $this->sinauto();
        } else {
            //dd($grado);
            $usuarios = User::where("idinstitucion", "=", Auth::User()->idinstitucion)->where("idtipousuario", "=", "3")->get();
            return view('admin.asignaciones.nuevo')->with('grado', $grado)->with("usuarios", $usuarios);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'idasignatura' => 'required',
            'idseccion' => 'required',
        ]);
        $find = Asignacion::where("idasignatura", "=", $request->idasignatura)->where("idseccion", "=", $request->idseccion)->first();
        if ($find) {
            Flash::warning("La materia ya se ha asignado a la seccion")->important();
            return $this->create($request->idgrado);
        }
        $item = new Asignacion($request->all());
        $item->save();
        Flash::success("La asignacion se ha realizado exitosamente")->important();
        return redirect()->route('asignaciones.index');
    }
    public function destroy($id){
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asignacion::with("asignatura.grado.nivel")->find($id);
        if (!$item || $item->asignatura->grado->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->delete($id);
        flash("La asignación ha sido eliminada de forma exitosa")->error()->important();
        return $this->index();
    }
    public function edit($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asignacion::with("asignatura.grado.nivel")->find($id);
        if (!$item || $item->asignatura->grado->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $grado = Grado::with("nivel", "secciones", "asignaturas")->find($item->asignatura->grado->idgrado);
        if (!$grado || $grado->nivel->idinstitucion != Auth::User()->idinstitucion) {
            return $this->sinauto();
        }
        $usuarios = User::where("idinstitucion", "=", Auth::User()->idinstitucion)->where("idtipousuario", "=", "3")->get();
        return view('admin.asignaciones.editar')->with('grado', $grado)->with("usuarios", $usuarios)->with('item',$item);
    }
    public function update(Request $request,$id){
        $request->validate([
            'idasignatura' => 'required',
            'idseccion' => 'required',
        ]);
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asignacion::with("asignatura.grado.nivel")->find($id);
        if (!$item || $item->asignatura->grado->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->idasignatura=$request->idasignatura;
        $item->idseccion=$request->idseccion;
        $item->idusuario=$request->idusuario;
        $item->save();
        Flash::success("La asignación ha sido actualizada de forma exitosa");
        return $this->index();
    }
}
