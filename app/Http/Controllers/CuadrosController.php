<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Nivel;
use App\Cuadro;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
class CuadrosController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        $items->each(function($items){
            $items->cuadros;
        });
        //dd($items);
        return view('admin.cuadros.index')->with('niveles', $items);
    }
    public function create()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        return view('admin.cuadros.nuevo')->with('niveles', $items);
        
    }
    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'descripcion' => 'required',
            'ponderacion'=>'required',
            'orden'=>'required',
            'idnivel'=>'required',
        ]);
        $item = new Cuadro($request->all());
        if ($item->autoagregar=="on"){
            $item->autoagregar=1;
        }else{
            $item->autoagregar=0;
        }
        $item->save();
        Flash::success("La categoria " . $item->nombre . " se ha creado exitosamente")->important();;
        return redirect()->route('cuadros.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Cuadro::where('idcuadro', '=', "$id")->first();
        if (!$item || $item->nivel->idinstitucion!=$idinstitucion) {
            flash("Error, el cuadro a eliminar no se encuentra o no tienes autorizacion")->error()->important();
            return redirect()->route('cuadros.index');
        };
        $item->delete($id);
        flash("La categoria " . $item->nombre . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('cuadros.index');
    }
    public function edit($id){
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Cuadro::where('idcuadro', '=', "$id")->first();
        if (!$item || $item->nivel->idinstitucion!=$idinstitucion) {
            flash("Error, el cuadro a editar no se encuentra o no tienes autorizacion para realizar esta acción")->error()->important();
            return redirect()->route('cuadros.index');
        };
        if($item->autoagregar==1){
            $item->autoagregar="checked";
        }else{
            $item->autoagregar="";
        }
        $niveles = Nivel::where('idinstitucion', '=', "$idinstitucion")->orderBy('idnivel', 'DESC')->paginate(10);
        return view('admin.cuadros.editar')->with('item', $item)->with('niveles', $niveles);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'descripcion' => 'required',
            'ponderacion'=>'required',
            'orden'=>'required',
            'idnivel'=>'required',
        ]);
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Cuadro::where('idcuadro', '=', "$id")->first();
        if (!$item || $item->nivel->idinstitucion!=$idinstitucion) {
            flash("Error, el cuadro a eliminar no se encuentra o no tienes autorizacion")->error()->important();
            return redirect()->route('cuadros.index');
        };
        if ($request->autoagregar=="on"){
            $chk=1;
        }else{
            $chk=0;
        }
        $item->nombre=$request->nombre;
        $item->descripcion=$request->descripcion;
        $item->ponderacion=$request->ponderacion;
        $item->orden=$request->orden;
        $item->idnivel=$request->idnivel;
        $item->autoagregar=$chk;
        $item->save();
        Flash::success("El cuadro " . $item->nombre . " se ha editado exitosamente")->important();
        return redirect()->route('cuadros.index');
    }
}
