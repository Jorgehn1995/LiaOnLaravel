<?php

namespace App\Http\Controllers;

use App\Grado;
use App\Inscripcion;
use Carbon\Carbon;
use App\Bloque;
use Illuminate\Support\Facades\Auth;

class GraficasController extends Controller
{
    public function home()
    {
        $bloques = Bloque::Where('idinstitucion', Auth::User()->idinstitucion)->where('eliminado', 0)->get();
        
        return view('admin.index')->with('institucion',Auth::User()->institucion)->with('cantidad', $this->cantidad())->with('grados', $this->grados())->with('edades', $this->edades())->with('inscritosdia', $this->inscritosdia())->with('bloques', $bloques);
    }
    public function index()
    {
        $response['cantidad'] = $this->cantidad();
        $response['grados']   = $this->grados();
        $response['edades']   = $this->edades();
        return $response;
    }
    public function cantidad()
    {
        $response['activos']   = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->where('ciclo', Auth::User()->institucion->ciclo)->count();
        $response['retirados'] = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 2)->where('ciclo', Auth::User()->institucion->ciclo)->count();
        $response['hombres']   = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->where('ciclo', Auth::User()->institucion->ciclo)->where('genero', 'm')->count();
        $response['mujeres']   = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->where('ciclo', Auth::User()->institucion->ciclo)->where('genero', 'f')->count();
        $response['total']     = $response['hombres'] + $response['mujeres']+ $response['retirados'];
        return $response;
    }
    public function grados()
    {
        $alumnos = Grado::where('idinstitucion', Auth::User()->idinstitucion)->get();
        $return  = array();
        foreach ($alumnos as $key => $value) {
            $response['idgrado'] = $value->idgrado;
            $response['grado']   = $value->nombre . " " . $value->seccion;
            $response['hombres'] = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->where('idgrado', $value->idgrado)->where('genero', 'm')->where('ciclo', Auth::User()->institucion->ciclo)->count();
            $response['mujeres'] = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->where('idgrado', $value->idgrado)->where('genero', 'f')->where('ciclo', Auth::User()->institucion->ciclo)->count();
            $response['total']   = $response['hombres'] + $response['mujeres'];
            array_push($return, $response);
        }
        return $return;
    }
    public function edades()
    {
        $alumnos = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('ciclo', Auth::User()->institucion->ciclo)->get();
        $return  = array();
        foreach ($alumnos as $key => $value) {
            $edad = Carbon::parse($value->nacimiento)->age;
            if (isset($response[$edad]['total'])) {
                if ($value->genero == 'm') {
                    $response[$edad]['hombres'] += 1;
                } else {
                    $response[$edad]['mujeres'] += 1;
                }
                $response[$edad]['total'] = $response[$edad]['hombres'] + $response[$edad]['mujeres'];

            } else {
                $response[$edad]['edad'] = $edad . " años";

                if ($value->genero == 'm') {

                    $response[$edad]['hombres'] = 1;
                    $response[$edad]['mujeres'] = 0;

                } else {
                    $response[$edad]['hombres'] = 0;
                    $response[$edad]['mujeres'] = 1;
                }
                $response[$edad]['total'] = $response[$edad]['hombres'] + $response[$edad]['mujeres'];
            }
        }
        sort($response);
        foreach ($response as $key => $edad) {
            array_push($return, $edad);
        }

        return $return;
    }
    public function inscritosdia()
    {
        $alumnos = Grado::where('idinstitucion', Auth::User()->idinstitucion)->get();
        $return  = array();
        foreach ($alumnos as $key => $value) {
            $response['idgrado'] = $value->idgrado;
            $response['grado']   = $value->nombre . " " . $value->seccion;
            $response['hombres'] = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->whereDate('created_at', Date('Y-m-d'))->where('idgrado', $value->idgrado)->where('genero', 'm')->where('ciclo', Auth::User()->institucion->ciclo)->count();
            $response['mujeres'] = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('idestado', 1)->whereDate('created_at', Date('Y-m-d'))->where('idgrado', $value->idgrado)->where('genero', 'f')->where('ciclo', Auth::User()->institucion->ciclo)->count();
            $response['total']   = $response['hombres'] + $response['mujeres'];
            array_push($return, $response);
        }
        return $return;

    }
}
