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
        dd($request->all());
    }
}
