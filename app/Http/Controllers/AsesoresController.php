<?php

namespace App\Http\Controllers;

use App\Asesor;
use App\Seccion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AsesoresController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Asesor::join('secciones', 'secciones.idseccion', '=', 'asesores.idseccion')
            ->join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->join('usuarios', 'usuarios.idusuario', '=', 'asesores.idusuario')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'DESC')
            ->orderBy('letra', 'ASC')
            ->paginate(10);
        //dd($items);
        return view('admin.asesores.index')->with('items', $items);

    }
    public function create()
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

        $usuarios = User::where('idinstitucion', '=', "$idinstitucion")
            ->where('idtipousuario', '=', "3")
            ->orderBy('nombre', 'ASC')->paginate(10);
        $usuarios->each(function ($usuarios) {
            $usuarios->tipo;
        });
        return view('admin.asesores.nuevo')->with('items', $items)->with('usuarios', $usuarios);
    }
    public function store(Request $request)
    {
        $request->validate([
            'idusuario' => 'required', //'required|unique:posts|max:255|min:5|email'
            'idseccion' => 'required',
        ]);
        $item = new Asesor($request->all());
        //dd($item);
        $item->save();
        Flash::success("El asesor se ha asignado exitosamente")->important();
        return redirect()->route('asesores.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asesor::join('secciones', 'secciones.idseccion', '=', 'asesores.idseccion')
            ->join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('usuarios', 'usuarios.idusuario', '=', 'asesores.idusuario')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')

            ->where('idasesor', '=', "$id")
            ->first();
        if (!$item) {
            flash("Error, el elemento a eliminar no se encuentra")->error()->important();
            return redirect()->route('asesores.index');
        };
        if ($item->idinstitucion != $idinstitucion) {
            flash("No tienes autorizacion para eliminar este elemento")->error()->important();
            return redirect()->route('asesores.index');
        }
        dd($item);
        $item->delete($id);
        flash("El asesor " . $item->nombre . " " . $item->apellido . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('asesores.index');
    }
    public function edit($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Asesor::select("asesores.idasesor","asesores.idusuario","asesores.idseccion","niveles.idinstitucion")->join('secciones', 'secciones.idseccion', '=', 'asesores.idseccion')
            ->join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('usuarios', 'usuarios.idusuario', '=', 'asesores.idusuario')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('idasesor', '=', "$id")
            ->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('asesores.index');
        };
        if ($item->idinstitucion != $idinstitucion) {
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('asesores.index');
        }
        $items = Seccion::join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'DESC')
            ->orderBy('letra', 'ASC')
            ->paginate(10);
        $usuarios = User::where('idinstitucion', '=', "$idinstitucion")
            ->where('idtipousuario', '=', "3")
            ->orderBy('nombre', 'ASC')->paginate(10);
        $usuarios->each(function ($usuarios) {
            $usuarios->tipo;
        });
        return view('admin.asesores.editar')->with('founds', $item)->with('items', $items)->with('usuarios', $usuarios);
    }
    public function update(Request $request, $id){
        //dd($request->all());
        $idinstitucion = Auth::user()->idinstitucion;
        $request->validate([
            'idusuario' => 'required', //'required|unique:posts|max:255|min:5|email'
            'idseccion' => 'required',
        ]);
        $item = Asesor::join('secciones', 'secciones.idseccion', '=', 'asesores.idseccion')
            ->join('grados', 'secciones.idgrado', '=', 'grados.idgrado')
            ->join('usuarios', 'usuarios.idusuario', '=', 'asesores.idusuario')
            ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('idasesor', '=', "$id")
            ->first();
        if (!$item) {
            flash("Error, el elemento a editar no se encuentra")->error()->important();
            return redirect()->route('asesores.index');
        };
        if ($item->idinstitucion != $idinstitucion) {
            flash("No tienes autorizacion para editar este elemento")->error()->important();
            return redirect()->route('asesores.index');
        }
        //dd($request->all());
        
        $item->idusuario=$request->idusuario;
        $item->idseccion=$request->idseccion;
        $item->save();
        flash("El asesor ha sido modificado de forma exitosa")->success()->important();
        return redirect()->route('asesores.index');
    }

}
