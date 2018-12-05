<?php

namespace App\Http\Controllers;

use App\Grado;

use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class GradosController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items         = Grado::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'ASC')->orderBy('seccion', 'ASC')->paginate(10);
        return view('admin.grados.index')->with('grados', $items);
    }
    public function create()
    {
        $profesores=Rol::where('idinstitucion',Auth::User()->idinstitucion)->where('rol',3)->get();
        return view('admin.grados.nuevo')->with('profesores',$profesores);
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'orden'   => 'required',
            'idrol'=>'required',
            'nivel'   => 'required', //'required|unique:posts|max:255|min:5|email'
            'grado'   => 'required',
            'corto'   => 'required',
            'seccion' => 'required',
        ];
        $messages = [
            'orden.required'   => 'El campo orden es requerido',
            'idrol.required'=>'Es necesario elegir un asesor',
            'nivel.required'   => 'El Nivel Educativo es requerido',
            'grado.required'   => 'El nombre del grado es requerido',
            'corto.required'   => 'El nombre corto del grado es requerido',
            'seccion.required' => 'La seccion es requerida',
        ];
        $this->validate($request, $rules, $messages);
        $niveles             = ['Pre-Primario', 'Primario', 'Básico / Secundaria', 'Diversificado / Preparatoria'];
        $item                = new Grado($request->all());
        $item->nombre        = $request->grado;
        $item->idnivel       = $request->nivel;
        $item->nivel         = $niveles[$request->nivel];
        $item->idinstitucion = Auth::User()->idinstitucion;
        //dd($item);
        $item->save();
        Flash::success("El grado " . $item->grado . " se ha creado exitosamente")->important();
        return redirect()->route('grados.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Grado::where('idgrado', '=', "$id")->first();
        if (!$item) {
            flash("Error, el grado a eliminar no se encuentra")->error()->important();
            return redirect()->route('grados.index');
        };
        if ($item->idinstitucion != $idinstitucion) {
            flash("No tienes autorizacion para eliminar este elemento")->error()->important();
            return redirect()->route('grados.index');
        }
        $item->delete($id);
        flash("El grado " . $item->grado . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('grados.index');
    }
    public function edit($id)
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $profesores = Rol::where('idinstitucion', Auth::User()->idinstitucion)->where('rol', 3)->get();
        $item          = Grado::where('idgrado', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('grados.index');
        };
        if ($item->idinstitucion != $idinstitucion) {
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('grados.index');
        }
        return view('admin.grados.editar')->with('grado', $item)->with('profesores',$profesores);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'orden' => 'required',
            'idrol' => 'required',
            'nivel' => 'required', //'required|unique:posts|max:255|min:5|email'
            'grado' => 'required',
            'corto' => 'required',
            'seccion' => 'required',
        ];
        $messages = [
            'orden.required' => 'El campo orden es requerido',
            'idrol.required' => 'Es necesario elegir un asesor',
            'nivel.required' => 'El Nivel Educativo es requerido',
            'grado.required' => 'El nombre del grado es requerido',
            'corto.required' => 'El nombre corto del grado es requerido',
            'seccion.required' => 'La seccion es requerida',
        ];
        $this->validate($request, $rules, $messages);
        $niveles = ['Pre-Primario', 'Primario', 'Básico / Secundaria', 'Diversificado / Preparatoria'];
        $item    = Grado::where('idgrado', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('grados.index');
        }
        if ($item->idinstitucion != Auth::User()->idinstitucion) {
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('grados.index');
        }
        $item->orden=$request->orden;
        $item->grado = $request->grado;
        $item->idnivel = $request->nivel;
        $item->nivel = $niveles[$request->nivel];
        $item->idrol=$request->idrol;
        $item->nombre  = $request->grado;
        $item->corto=$request->corto;
        $item->seccion=$request->seccion;
        $item->save();

        Flash::success("El grado " . $item->nombre . " se ha editado exitosamente")->important();
        return redirect()->route('grados.index');
    }
}
