<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\Grado;
use App\Nivel;

use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

use Illuminate\Http\Request;

class AsignaturasController extends Controller
{
    public function show(){
        return $this->index();
    }
    public function sinauto()
    {
        flash("Error #0000008: el elemento no se encuentra o no tienes autorización para realizar esta acción")->error()->important();
        return $this->index();
    }
    public function index(){
        $items = Nivel::where('idinstitucion', Auth::User()->idinstitucion)
        ->paginate(10);
        return view('admin.asignaturas.index')->with('niveles', $items);
    }
    public function create($idgrado = 0){
        //dd($idgrado);
        $grado = Grado::with("nivel")->find($idgrado);
        if (!$grado || $grado->nivel->idinstitucion != Auth::User()->idinstitucion) {
            return $this->sinauto();
        } else {
            return view('admin.asignaturas.nuevo')->with('grado', $grado)->with('nivel',$grado->nivel);
        }
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'idgrado' => 'required',
            'nombre' => 'required',
            'corto' => 'required', //'required|unique:posts|max:255|min:5|email'
            'orden' => 'required',
        ]);

        $item = new Asignatura($request->all());
        $item->mostrar=1;
        $item->activo=1;
        $item->save();
        Flash::success("La asignatura " . $item->nombre . " se ha creado exitosamente")->important();
        return redirect()->route('asignaturas.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asignatura::with("grado.nivel")->find($id);
        if (!$item || $item->grado->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->delete($id);
        flash("La asignatura " . $item->nombre . " ha sido eliminado de forma exitosa")->error()->important();
        return $this->index();
    }
    public function edit($id){
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asignatura::with("grado.nivel")->find($id);
        if (!$item || $item->grado->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->mostrar = ($item->mostrar == '1') ? "checked" : "";
        $item->activo = ($item->activo == '1') ? "checked" : "";
        return view('admin.asignaturas.editar')->with('item',$item);
    }
    public function update(Request $request,$id){
        //dd($request->all());
        $request->validate([
            'idgrado' => 'required',
            'nombre' => 'required',
            'corto' => 'required', //'required|unique:posts|max:255|min:5|email'
            'orden' => 'required',
        ]);
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asignatura::with("grado.nivel")->find($id);
        if (!$item || $item->grado->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->idgrado=$request->idgrado;
        $item->nombre=$request->nombre;
        $item->corto=$request->corto;
        $item->orden=$request->orden;
        $item->mostrar = ($request->mostrar == 'on') ? 1 : 0;
        $item->activo = ($request->activo == 'on') ? 1 : 0;
        $item->save();
        Flash::success("La asignatura " . $item->nombre . " se ha editado exitosamente");
        return $this->index();
    }
}
