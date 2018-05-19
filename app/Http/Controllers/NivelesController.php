<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Nivel;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class NivelesController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $niveles = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        return view('admin.niveles.index')->with('niveles', $niveles);
    }
    public function create()
    {
        
        return view('admin.niveles.nuevo');
    }
    public function store(Request $request)
    {
        $item = new Nivel($request->all());
        $request->validate([
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'corto' => 'required',
        ]);
        $item->idinstitucion = Auth::user()->idinstitucion;
        $item->save();
        Flash::success("El nivel " . $item->nombre . " se ha creado exitosamente")->important();;
        return redirect()->route('niveles.index');

    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Nivel::where('idnivel', '=', "$id")->where('idinstitucion', '=', "$idinstitucion")->first();
        $item->delete($id);
        flash("El nivel " . $item->nombre . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('niveles.index');
    }
    public function edit($id)
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $item = Nivel::where('idnivel', '=', "$id")->where('idinstitucion', '=', "$idinstitucion")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('niveles.index');
        };
        return view('admin.niveles.editar')->with('item', $item);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'corto' => 'required',
        ]);
        $idinstitucion = Auth::User()->idinstitucion;
        $item = Nivel::where('idnivel', '=', "$id")->where('idinstitucion', '=', "$idinstitucion")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('niveles.index');
        };
        $item->idinstitucion = Auth::user()->idinstitucion;
        $item->nombre=$request->nombre;
        $item->corto=$request->corto;
        $item->descripcion=$request->descripcion;
        $item->save();
        Flash::success("El nivel " . $item->nombre . " se ha editado exitosamente");
        return redirect()->route('niveles.index');
    }
    public function show($id)
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $item = Nivel::where('idnivel', '=', "$id")->where('idinstitucion', '=', "$idinstitucion")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('niveles.index');
        };
        return view('admin.niveles.mostrar')->with('item', $item);

    }
}
