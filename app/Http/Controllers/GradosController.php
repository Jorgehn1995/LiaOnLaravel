<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Nivel;
use App\Grado;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class GradosController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        $items->each(function($items){
            $items->grados;
        });
        return view('admin.grados.index')->with('niveles', $items);

    }
    public function create()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        return view('admin.grados.nuevo')->with('niveles', $items);
    }
    public function store(Request $request){
        
        $request->validate([
            'orden' => 'required', //'required|unique:posts|max:255|min:5|email'
            'grado' => 'required',
            'idnivel'=>'required',
        ]);
        $item = new Grado($request->all());

        $item->save();
        Flash::success("El grado " . $item->grado . " se ha creado exitosamente")->important();;
        return redirect()->route('grados.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Grado::where('idgrado', '=', "$id")->first();
        if (!$item) {
            flash("Error, el grado a eliminar no se encuentra")->error()->important();
            return redirect()->route('grados.index');
        };
        if($item->nivel->idinstitucion!=$idinstitucion){
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
        $item = Grado::where('idgrado', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('grados.index');
        };
        if($item->nivel->idinstitucion!=$idinstitucion){
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('grados.index');
        }
        $niveles = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        return view('admin.grados.editar')->with('item', $item)->with('niveles', $niveles);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'orden' => 'required', //'required|unique:posts|max:255|min:5|email'
            'grado' => 'required',
            'idnivel'=>'required',
        ]);
        $idinstitucion = Auth::User()->idinstitucion;
        $item = Grado::where('idgrado', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('grados.index');
        };
        if($item->nivel->idinstitucion!=$idinstitucion){
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('grados.index');
        }
        $item->orden=$request->orden;
        $item->grado=$request->grado;
        $item->idnivel=$request->idnivel;
        $item->save();
        Flash::success("El grado " . $item->nombre . " se ha editado exitosamente")->important();
        return redirect()->route('grados.index');
    }
}
