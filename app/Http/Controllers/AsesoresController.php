<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Grado;
use App\Seccion;
use App\Asesor;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AsesoresController extends Controller
{
    public function index()
    {
        $idinstitucion = Auth::User()->idinstitucion;
        $items= Asesor::join('secciones','secciones.idseccion','=','asesores.idseccion')
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
    
}
