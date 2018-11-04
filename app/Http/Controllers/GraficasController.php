<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficasController extends Controller
{
    public function cantidad(){
        $response=array(
            "title"=>"titulo del mensaje",
            "body"=>"cuerpo del mensaje",
            "msg"=>"mensaje"
        );
        return $response;
    }
}
