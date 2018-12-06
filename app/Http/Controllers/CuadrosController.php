<?php

namespace App\Http\Controllers;

use App\Cuadro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class CuadrosController extends Controller
{
    protected $saberes = array("Saber", "Saber Hacer", "Saber Ser", "Saber Convivir", "Saber Emprender");
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items         = Cuadro::where('idinstitucion', $idinstitucion)->where('eliminado', 0)->orderBy('orden', 'ASC')->get();
        return view('admin.cuadros.index')->with('cuadros', $items);
    }
    public function create()
    {
        return view('admin.cuadros.nuevo')->with("saberes", $this->saberes);
    }
    public function store(Request $request)
    {
        $ultimo=Cuadro::where("idinstitucion",Auth::User()->idinstitucion)->where('eliminado',0)->orderBy('orden', 'DESC')->first();
        if(!$ultimo){
            $or=1;
        }else{
            $or=$ultimo->orden+1;
        }
        $rules = [
            'idsaber' => 'required',
            'nombre'  => 'required',
        ];
        $messages = [
            'idsaber.required' => 'Es necesario que especifique el tipo de actividad',
            'nombre.required'  => 'Es necesario que especifique el nombre de la actividad',
        ];
        $this->validate($request, $rules, $messages);
        $saber               = $request->idsaber - 1;
        $item                = new Cuadro($request->all());
        $item->orden=$or;
        $item->idinstitucion = Auth::User()->idinstitucion;
        $item->saber         = $this->saberes[$saber];
        $item->save();
        Flash::success("La actividad " . $item->nombre . " se ha creado exitosamente")->important();
        return redirect()->route('cuadros.index');
    }
    public function destroy($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Cuadro::find($id);
        if (!$item || $item->idinstitucion != $idinstitucion) {
            flash("Error, el cuadro a eliminar no se encuentra o no tienes autorizacion")->error()->important();
            return redirect()->route('cuadros.index');
        };
        $item->eliminado = 1;
        $item->save();
        flash("La actividad " . $item->nombre . " ha sido eliminado de forma exitosa")->error()->important();
        return redirect()->route('cuadros.index');
    }
    public function edit($id)
    {
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Cuadro::find($id);
        if (!$item || $item->idinstitucion != $idinstitucion) {
            flash("Error, el cuadro a editar no se encuentra o no tienes autorizacion para realizar esta acción")->error()->important();
            return redirect()->route('cuadros.index');
        };

        return view('admin.cuadros.editar')->with('cuadro', $item)->with('saberes', $this->saberes);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'idsaber' => 'required',
            'nombre'  => 'required',
        ];
        $messages = [
            'idsaber.required' => 'Es necesario que especifique el tipo de actividad',
            'nombre.required'  => 'Es necesario que especifique el nombre de la actividad',
        ];
        $this->validate($request, $rules, $messages);
        $idinstitucion = Auth::user()->idinstitucion;
        $item          = Cuadro::find($id);
        if (!$item || $item->idinstitucion != $idinstitucion) {
            flash("Error, el cuadro a eliminar no se encuentra o no tienes autorizacion")->error()->important();
            return redirect()->route('cuadros.index');
        };
        $item->idsaber     = $request->idsaber;
        $item->saber       = $this->saberes[$request->idsaber - 1];
        $item->nombre      = $request->nombre;
        $item->punteo      = $request->punteo;
        $item->descripcion = $request->descripcion;
        $item->asesor      = $request->asesor;
        $item->renombrar   = $request->renombrar;
        $item->save();
        Flash::success("La actividad " . $item->nombre . " se ha editado exitosamente")->important();
        return redirect()->route('cuadros.index');
    }
    public function ordenar(Request $request)
    {
        $idinstitucion = Auth::User()->idinstitucion;
        if ($request->orden == "") {
            Flash::success("Orden establecido correctamente 0x001")->important();
            return redirect()->route('cuadros.index');
        }
        $orden = explode(";", $request->orden);
        foreach ($orden as $key => $value) {
            $cuadro = Cuadro::find($value);
            if (!$cuadro || $cuadro->idinstitucion != $idinstitucion) {
                Flash::success("Orden establecido correctamente 0x00".$key)->important();
                return redirect()->route('cuadros.index');
            } else {
                $cuadro->orden = $key + 1;
                $cuadro->save();
            }
        }
        Flash::success("Orden establecido correctamente")->important();
        return redirect()->route('cuadros.index');

    }
}
