<?php

namespace App\Http\Controllers;

use App\Grado;
use App\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListadosController extends Controller
{
    public function index($id = 0)
    {
        if ($id != 0) {
            $comprobar = Grado::where('idinstitucion', Auth::User()->idinstitucion)->where('idgrado', $id)->count();
            if ($comprobar == 0) {
                $id = 0;
            }
        }
        $listado = "";
        if ($id != 0) {
            $listado = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idgrado', $id)->orderBy('clave', 'DESC')->get();
            $listado->each(function($listado){
                $listado->edad=Carbon::parse($listado->nacimiento)->age;
            });
        }
        $grados = Grado::where('idinstitucion', Auth::User()->idinstitucion)->get();
        return view('admin.listados.index')->with('grados', $grados)->with('idgrado', $id)->with('listado', $listado);
    }
}
