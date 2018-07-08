<?php

namespace App\Http\Controllers;

use App\Cuadro;
use App\Modelo;
use App\Nivel;

use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
class ModelosController extends Controller
{
    public function sinauto()
    {
        flash("Error, el elemento no se encuentra no se encuentra o no tienes autorización para realizar esta acción")->error()->important();
        return $this->index();
    }
    public function show()
    {
        return $this->index();
    }
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items = Nivel::with('cuadros.modelos')->where('idinstitucion', "$idinstitucion")
            ->paginate(10);
        return view('admin.modelos.index')->with('niveles', $items);
    }
    public function create($idnivel = 0)
    {
        $nivel = Nivel::find($idnivel);
        if (!$nivel || $nivel->idinstitucion != Auth::User()->idinstitucion) {
            return $this->index();
        } else {
            $cuadros = Cuadro::where("idnivel", "=", "$idnivel")->get();
            return view('admin.modelos.nuevo')->with('cuadros', $cuadros)->with('nivel', $nivel);
        }
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'idnivel' => 'required',
            'idcuadro' => 'required',
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'punteo' => 'required',
            'orden' => 'required',
        ]);

        $item = new Modelo($request->all());
        $item->asesor = ($item->asesor == 'on') ? 1 : 0;
        $item->renombrar = ($item->renombrar == 'on') ? 1 : 0;
        $item->save();
        Flash::success("La actividad " . $item->nombre . " se ha creado exitosamente")->important();
        return redirect()->route('modelos.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Modelo::with('cuadro.nivel')->find($id);
        if (!$item || $item->cuadro->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->delete($id);
        flash("La actividad " . $item->nombre . " ha sido eliminado de forma exitosa")->error()->important();
        return $this->index();
    }
    public function edit($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Modelo::with('cuadro.nivel')->find($id);
        if (!$item || $item->cuadro->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->asesor = ($item->asesor == '1') ? "checked" : "";
        $item->renombrar = ($item->renombrar == '1') ? "checked" : "";
        $nivel = Nivel::find($item->cuadro->nivel->idnivel);
        $cuadros = Cuadro::where("idnivel", "=", $item->cuadro->nivel->idnivel)->get();
        return view('admin.modelos.editar')->with('cuadros', $cuadros)->with('nivel', $nivel)->with('item', $item);
    }
    public function update(Request $request, $id){
        $request->validate([
            'idnivel' => 'required',
            'idcuadro' => 'required',
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'punteo' => 'required',
            'orden' => 'required',
        ]);
        $idinstitucion = Auth::user()->idinstitucion;
        $item = Modelo::with('cuadro.nivel')->find($id);
        if (!$item || $item->cuadro->nivel->idinstitucion != $idinstitucion) {
            return $this->sinauto();
        };
        $item->idcuadro=$request->idcuadro;
        $item->nombre=$request->nombre;
        $item->descripcion=$request->descripcion;
        $item->punteo=$request->punteo;
        $item->orden=$request->orden;
        $item->asesor = ($request->asesor == 'on') ? 1 : 0;
        $item->renombrar = ($request->renombrar == 'on') ? 1 : 0;
        $item->save();
        Flash::success("La actividad " . $item->nombre . " se ha editado exitosamente");
        return $this->index();
    }
}
