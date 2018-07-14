<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorariosController extends Controller
{
    public function index(){
        return view('admin.horarios.index');
    }
}
