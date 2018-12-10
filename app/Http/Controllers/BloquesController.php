<?php

namespace App\Http\Controllers;

use App\Bloque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class BloquesController extends Controller
{
    public function index()
    {
        $bloques = Bloque::Where('idinstitucion', Auth::User()->idinstitucion)->where('eliminado', 0)->get();
        return view('admin.bloques.index')->with('bloques', $bloques);
    }
    public function create()
    {
        return view('admin.bloques.nuevo');
    }
    public function store(Request $request)
    {
        $rules = [
            'bloque' => 'required',
            'nombre' => 'required',
        ];
        $messages = [
            'bloque.required' => 'El numero del bloque es obligatorio',
            'nombre.required' => 'Es nombre del bloque es obligatorio',
        ];
        $this->validate($request, $rules, $messages);
        $b = Bloque::where('idinstitucion', Auth::User()->idinstitucion)->where('eliminado', 0)->where('bloque', $request->bloque)->count();
        if ($b > 0) {
            Flash::error("El blque $request->bloque ya ha sido agregado")->important();
            return redirect()->route('bloques.index');
        }

        $bloque                                           = new Bloque($request->all());
        $bloque->idinstitucion                            = Auth::User()->idinstitucion;
        (is_null($request->profesor)) ? $bloque->profesor = 0 : $bloque->profesor = 1;
        (is_null($request->alumno)) ? $bloque->alumno     = 0 : $bloque->alumno     = 1;
        (is_null($request->padre)) ? $bloque->padre       = 0 : $bloque->padre       = 1;
        $bloque->save();
        Flash::success("El bloque ha sigo agregado exitosamente")->important();
        return redirect()->route('bloques.index');
    }
    public function edit($id)
    {
        $bloque = Bloque::find($id);
        if (!$bloque || $bloque->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("no tienes permiso de realizar esta accion")->important();
            return redirec()->route('bloques.index');
        }
        return view('admin.bloques.editar')->with('bloque', $bloque);
    }
    public function update(Request $request, $id)
    {

        $rules = [
            'bloque' => 'required',
            'nombre' => 'required',
        ];
        $messages = [
            'bloque.required' => 'El numero del bloque es obligatorio',
            'nombre.required' => 'Es nombre del bloque es obligatorio',
        ];
        $this->validate($request, $rules, $messages);
        $bloque = Bloque::find($id);
        if (!$bloque || $bloque->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error no tienes acceso")->important();
            return redirect()->route('bloques.index');
        }
        $b = Bloque::where('idinstitucion', Auth::User()->idinstitucion)->where('eliminado', 0)->where('bloque', $request->bloque)->where('idbloque', '!=', $id)->count();
        if ($b > 0) {
            Flash::error("El blque $request->bloque ya ha sido agregado")->important();
            return redirect()->route('bloques.index');
        }
        $bloque->bloque     = $request->bloque;
        $bloque->nombre     = $request->nombre;
        $bloque->porcentaje = $request->porcentaje;
        $bloque->save();
        Flash::success("El bloque ha sigo modificado exitosamente")->important();
        return redirect()->route('bloques.index');
    }
    public function destroy($id)
    {
        $bloque = Bloque::find($id);
        if (!$bloque || $bloque->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("El bloque no se encuentra")->important();
            return redirect()->route('bloques.index');
        }
        $bloque->eliminado = 1;
        $bloque->save();
        Flash::error("El bloque ha sido eliminado exitosamente")->important();
        return redirect()->route('bloques.index');
    }
    public function mostrar(Request $request)
    {
        $bloque = Bloque::find($request->idbloque);
        if (!$bloque || $bloque->idinstitucion != Auth::User()->idinstitucion) {
            $response['status'] = "false";
            $response['msg']    = "No se encuentra la propiedad";
            return $response;
        }

        switch ($request->tipo) {
            case "profesor":
                $bloque->profesor = $request->estado;
                break;
            case "alumno":
                $bloque->alumno = $request->estado;
                break;
            case "padre":
                $bloque->padre = $request->estado;
                break;
        }
        $bloque->save();
        $response['status'] = "true";
        $response['title'] = "Cambios Guardados";

        $response['msg']    = "Se ha actualizado la visualización";
        $response['checked']= ($request->estado==1);
        return $response;
    }
}
