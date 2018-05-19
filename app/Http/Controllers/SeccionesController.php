<?php

namespace App\Http\Controllers;

use App\Grado;
use App\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class SeccionesController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Seccion::join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'DESC')
            ->orderBy('letra', 'ASC')
            ->paginate(10);
        //dd($items);
        return view('admin.secciones.index')->with('items', $items);

    }
    public function create()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'ASC')
            ->paginate(10);
        return view('admin.secciones.nuevo')->with('items', $items);
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'letra' => 'required|max:1', //'required|unique:posts|max:255|min:5|email'
            'idgrado' => 'required',
        ]);
        $item = new Seccion($request->all());
        //dd($item);
        $item->save();
        Flash::success("La seccion " . $item['letra'] . " se ha creado exitosamente")->important();
        return redirect()->route('secciones.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Seccion::join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('idseccion', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a eliminar no se encuentra")->error()->important();
            return redirect()->route('secciones.index');
        };
        if ($item->idinstitucion != $idinstitucion) {
            flash("No tienes autorizacion para eliminar este elemento")->error()->important();
            return redirect()->route('secciones.index');
        }
        $item->delete($id);
        flash("La seccion " . $item->letra . " del grado " . $item->grado . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('secciones.index');
    }
    public function edit($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Seccion::join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('idseccion', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('secciones.index');
        };
        if($item->idinstitucion!=$idinstitucion){
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('secciones.index');
        }
        $grado = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'ASC')
            ->paginate(10);
        return view('admin.secciones.editar')->with('item', $item)->with('grados', $grado);

    }
    public function update(Request $request, $id){
         $request->validate([
            'letra' => 'required|max:1', //'required|unique:posts|max:255|min:5|email'
            'idgrado' => 'required',
        ]);
        $idinstitucion = Auth::User()->idinstitucion;
        $item = Seccion::join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('idseccion', '=', "$id")->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('secciones.index');
        };
        if($item->idinstitucion!=$idinstitucion){
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('secciones.index');
        }


        $item->letra=$request->letra;
        $item->nombresec=$request->nombresec;
        $item->idgrado=$request->idgrado;
        $item->save();
        flash("La seccion " . $item->letra . " del grado " . $item->grado . " ha sido modificada de forma exitosa")->success()->important();
        return redirect()->route('secciones.index');
    }

}
