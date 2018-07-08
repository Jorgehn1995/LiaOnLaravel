<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    public function index(){
        $items = Nivel::where('idinstitucion', Auth::User()->idinstitucion)
        ->paginate(10);
        return view('admin.asignaturas.index')->with('niveles', $items);
    }
}
