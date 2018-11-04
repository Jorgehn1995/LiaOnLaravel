<?php

namespace App\Http\Controllers;


use App\Inscripcion;
use App\Nivel;
use App\Grado;
use App\Seccion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class JsonAjaxController extends Controller
{
    public function consultacodigo($id=""){
        
        if  ($id==""){
            return "false";
        }
        $usuario = User::where("codigo", "=", $id)->first();
        if (!$usuario) {
            return ("false");
        } else {
            $age = Carbon::parse($usuario->nacimiento)->age;
            $usuario->labelnacimiento = date("d/m/Y", strtotime($usuario->nacimiento)) . " <span class='badge badge-success'>($age años)</span>";
            if ($usuario->genero == "F") {
                $usuario->labelgenero = " <span class='badge badge-pink'>Femenino</span>";
            } else {
                $usuario->labelgenero = " <span class='badge badge-info'>Masculino</span>";
            }
            return $usuario;
        }
    }
    public function grados(){
        $grados = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->join('instituciones', 'niveles.idinstitucion', '=', 'instituciones.idinstitucion')
            ->select('grados.*','niveles.corto', 'instituciones.idinstitucion')
            ->where('instituciones.idinstitucion',Auth::User()->idinstitucion)
            ->get();
            return $grados;
    }
    public function secciones($idgrado=0){
        $seccion = Seccion::where("idgrado",$idgrado)
            
            ->get();
            return $seccion;
    }
    public function alumnosinscritos(){
        $alumnos = Inscripcion::where("idinstitucion", Auth::User()->institucion->idinstitucion)->where("idestado", "!=", "3")->orderBy('updated_at','DESC')->get();
        /*$alumnos = Inscripcion::join('grados','inscripciones.idgrado',"=",'grados.idgrado')
        ->join('estados','inscripciones.idestado',"=",'estados.idestado')
        ->join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
        ->select('niveles.*','inscripciones.*','estados.*','grados.*','niveles.nombre as nivelnombre')
        ->where("inscripciones.idinstitucion", Auth::User()->institucion->idinstitucion)->where("inscripciones.idestado", "!=", "3")->orderBy("updated_at","DESC")->get();*/
        
        $alumnos->each(function ($alumnos) {
            $alumnos->grado=$alumnos->grado;
            $alumnos->nivel=$alumnos->grado->nivel;
            $alumnos->seccion=$alumnos->seccion;
            $alumnos->estado=$alumnos->estado;
            $alumnos->fullname=$alumnos->nombre." ".$alumnos->apellido;
            /**if(Carbon::parse($alumnos->nacimiento)->age>100 || $alumnos->nacimiento==null || $alumnos->genero==null){
                $alumnos->nacimiento=$alumnos->usuario->nacimiento;
                $a=Inscripcion::find($alumnos->idinscripcion);
                $a->genero=$alumnos->usuario->genero;
                $a->nacimiento=$alumnos->usuario->nacimiento;
                $a->save();
            }*/
            
            $alumnos->edad=Carbon::parse($alumnos->nacimiento)->age." años";
            $alumnos->nacimiento=date("d/m/Y",strtotime($alumnos->nacimiento));
            
            if($alumnos->foto==''){
                $alumnos->foto=asset('images/app/user.jpg');
            }
            $alumnos->editroute=route('alumnos.edit',$alumnos->idinscripcion);
        });
        
        return $alumnos;
    }
}
