<?php

namespace App\Http\Controllers;

use App\Grado;
use App\Informacion;
use App\Inscripcion;
use App\Nivel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AlumnosController extends Controller
{
    public function create()
    {
        return view('admin.alumnos.nuevo');
    }
    public function show($id)
    {
        $usuario = User::where("codigo", "=", $id)->first();
        if (!$usuario) {
            return ("false");
        } else {
            $age                 = Carbon::parse($usuario->nacimiento)->age;
            $usuario->nacimiento = date("d/m/Y", strtotime($usuario->nacimiento)) . " <span class='badge badge-success'>($age años)</span>";
            if ($usuario->genero == "F") {
                $usuario->genero = " <span class='badge badge-pink'>Femenino</span>";
            } else {
                $usuario->genero = " <span class='badge badge-info'>Masculino</span>";
            }
            return ($usuario);
        }
    }
    public function index()
    {
        //$alumnos = Inscripcion::where("idinstitucion", "=", Auth::User()->institucion->idinstitucion)->where("idestado", "!=", "3")->orderBy("idinscripcion","DESC")->limit(6)->get();
        //dd($alumnos);

        return view('admin.alumnos.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'codigo'     => 'unique:usuarios',
            'nombre'     => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido'   => 'required',
            'genero'     => 'required',
            'nacimiento' => 'required',
        ]);
        //dd($request->all());
        $item                = new User($request->all());
        $item->usuario       = $request->codigo;
        $ps                  = date("Y", strtotime($request->nacimiento));
        $item->password      = bcrypt($ps);
        $item->idtipousuario = 4;
        $item->idinstitucion = Auth::User()->institucion->idinstitucion;
        $item->codigo        = $request->codigo;
        $item->save();
        $usuario = $item;
        //dd($usuario->idusuario);
        $response = array(
            "message" => "true",
            "title"   => "Exito",
            "body"    => "El usuario ha sido registrado exitosamente",
            "usuario" => $item,

        );
        return $response;
    }
    public function inscripcion($id = 0)
    {
        if ($id == 0) {
            return "false";
        }
        $usuario            = User::find($id);
        $usuario->edad      = $this->edad($usuario->nacimiento);
        $usuario->pass      = date("Y", strtotime($usuario->nacimiento));
        $usuario->direccion = ($usuario->direccion == "") ? "No Registrada" : $usuario->direccion;
        $usuario->generol   = ($usuario->genero == "M") ? "Masculino" : "Femenino";
        $usuario->y         = date("Y");
        /** se comprueba que no este inscrito en el establecimiento */
        $ciclo       = date("Y");
        $inscripcion = Inscripcion::where("idinstitucion", "=", Auth::User()->institucion->idinstitucion)->where("idusuario", "=", $usuario->idusuario)->where("ciclo", "=", $ciclo)->first();
        if ($inscripcion) {
            Flash::success("El alumno ya se encuentra registrado en el ciclo escolar $ciclo ")->important();
            return redirect()->route('alumnos.comprobante', ['idinscripcion' => $inscripcion->idinscripcion]);
            //return $this->comprobante($request->idusuario);
        }

        /** se reunen y buscan los grados */
        $idinstitucion = Auth::User()->idinstitucion;
        $grados        = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'ASC')
            ->paginate(10);
        return view('admin.alumnos.inscripcion')->with("usuario", $usuario)->with("grados", $grados);
    }
    public function comprobante($id)
    {
        $comprobante = Inscripcion::find($id);
        $usuario     = User::find($comprobante->usuario->idusuario);
        if ($comprobante->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error al procesar la solicitud ID de Institucion $id")->important();
            return $this->index();
        }
        $usuario->edad      = $this->edad($usuario->nacimiento);
        $usuario->pass      = date("Y", strtotime($usuario->nacimiento));
        $usuario->direccion = ($usuario->direccion == "") ? "No Registrada" : $usuario->direccion;
        $usuario->generol   = ($usuario->genero == "M") ? "Masculino" : "Femenino";
        $usuario->y         = date("Y");
        /** se reunen y buscan los grados */
        $idinstitucion = Auth::User()->idinstitucion;
        $grados        = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'ASC')
            ->paginate(10);
        return view('admin.alumnos.comprobante')->with("inscripcion", $comprobante);
    }
    public function edad($fecha)
    {
        list($ano, $mes, $dia) = explode("-", $fecha);
        $ano_diferencia        = date("Y") - $ano;
        $mes_diferencia        = date("m") - $mes;
        $dia_diferencia        = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0) {
            $ano_diferencia--;
        }
        return $ano_diferencia;
    }
    public function inscribir(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'idusuario' => 'required',
            'idgrado'   => 'required', //'required|unique:posts|max:255|min:5|email'
        ]);
        $ciclo       = date("Y");
        $inscripcion = Inscripcion::where("idinstitucion", "=", Auth::User()->institucion->idinstitucion)->where("idusuario", "=", $request->idusuario)->where("ciclo", "=", $ciclo)->first();
        $user        = User::find($request->idusuario);
        if ($inscripcion) {
            $response = array(
                "message" => "false",
                "title"   => "Alumno Inscrito",
                "body"    => "El alumno $inscripcion->nombre $inscripcion->apellido ya se encuentra inscrito en " . Auth::User()->institucion->abr . " para el ciclo escolar  $request->ciclo",
                "type"    => "warning",

            );
            return $response;
            //return $this->comprobante($request->idusuario);
        } else {
            $inscrip                = new Inscripcion($request->all());
            $inscrip->ciclo         = $request->ciclo;
            $inscrip->idusuario     = $request->idusuario;
            $inscrip->idgrado       = $request->idgrado;
            $inscrip->idseccion     = $request->idseccion;
            $inscrip->encargado     = $request->encargado;
            $inscrip->contacto      = $request->telencargado;
            $inscrip->nombre        = $user->nombre;
            $inscrip->apellido      = $user->apellido;
            $inscrip->codigo        = $user->codigo;
            $inscrip->registrador   = Auth::User()->idusuario;
            $inscrip->idinstitucion = Auth::User()->institucion->idinstitucion;
            $inscrip->idestado      = 1;
            $inscrip->resultado     = 2;
            $inscrip->save();
            $response = array(
                "message" => "true",
                "title"   => "Exito",
                "body"    => "El usuario ha sido inscrito exitosamente",
                "type"    => "success",
                "usuario" => $inscrip,

            );
            return $response;
        }
    }
    public function edit($id)
    {
        $comprobante = Inscripcion::find($id);

        if ($comprobante->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error al procesar la solicitud ID de Institución $id")->important();
            return $this->index();
        }
        $niveles = Nivel::where("idinstitucion", "=", Auth::User()->idinstitucion)->get();
        if (!$niveles) {
            Flash::error("Error al procesar la solicitud: No existen Niveles Registrados")->important();
            return $this->index();
        }
        //dd($niveles);
        return view('admin.alumnos.editar')->with("inscripcion", $comprobante)->with("niveles", $niveles);
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'nombre'     => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido'   => 'required',
            'genero'     => 'required',
            'nacimiento' => 'required',
            'idgrado'    => 'required',
            'idseccion'    => 'required',
        ]);
        $inscripcion = Inscripcion::find($id);
        if (!$inscripcion || $inscripcion->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error al procesar la solicitud de actualización: ID de Institución $id")->important();
            return $this->index();
        }
        /** Se inicia la actualizacion de la tabla inscripciones */

        $inscripcion->idestado = $request->idestado;
        $inscripcion->idgrado   = $request->idgrado;
        $inscripcion->idseccion = $request->idseccion;
        $inscripcion->comentario = $request->otro;
        $inscripcion->nacimiento = $request->nacimiento;
        $inscripcion->encargado= $request->encargado;
        $inscripcion->contacto= $request->telencargado;
        $inscripcion->direccion= $request->direccion;
        $inscripcion->nombre= $request->nombre;
        $inscripcion->apellido= $request->apellido;
        $inscripcion->codigo= $request->codigo;
        $inscripcion->actualizador= Auth::User()->idusuario;
        //dd($inscripcion);
        $inscripcion->save();
        //dd($inscripcion);
        Flash::success("El alumno $inscripcion->nombre $inscripcion->apellido se ha modificado exitosmente")->important();
        return redirect()->route('alumnos.index');
        
    }
    public function destroy($id)
    {
        $inscripcion = Inscripcion::find($id);
        if (!$inscripcion || $inscripcion->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error al procesar la solicitud de eliminacion de inscripcion: ID de inscripcion $id")->important();
            return $this->index();
        }
        $inscripcion->idestado = 3;
        $inscripcion->save();
        Flash::success("La inscripcion del alumno se ha eliminado exitosamente")->important();
        return $this->index();
    }
    public function agregar(Request $request)
    {
        $ciclo = Auth::User()->institucion->ciclo;
        //dd($request->all());
        if ($request->update == 1) {
            $response = array(
                "message" => "false",
                "title"   => "Peticion Recibida",
                "body"    => "aqui actualizarias el contenido",
                "type"    => "warning",

            );
            return $response;
        }
        if ($request->idusuario != "" || $request->idusuario != 0) {
            $item        = User::find($request->idusuario);
            $inscripcion = Inscripcion::where("idinstitucion", "=", Auth::User()->institucion->idinstitucion)->where("idusuario", "=", $item->idusuario)->where("ciclo", "=", $ciclo)->first();
            if ($inscripcion) {
                $response = array(
                    "message" => "false",
                    "title"   => "Alumno Inscrito",
                    "body"    => "El alumno $inscripcion->nombre $inscripcion->apellido ya se encuentra inscrito en " . Auth::User()->institucion->abr . " para el ciclo escolar  $request->ciclo",
                    "type"    => "warning",

                );
                return $response;
            }
        }
        $item                = new User($request->all());
        $item->usuario       = $request->codigo;
        $ps                  = date("Y", strtotime($request->nacimiento));
        $item->password      = bcrypt($ps);
        $item->idtipousuario = 4;
        $item->idinstitucion = Auth::User()->institucion->idinstitucion;
        $item->codigo        = $request->codigo;

        $item->save();
        $inscrip                = new Inscripcion($request->all());
        $inscrip->ciclo         = Auth::User()->institucion->ciclo;
        $inscrip->idusuario     = $item->idusuario;
        $inscrip->idgrado       = $request->idgrado;
        $inscrip->idseccion     = $request->idseccion;
        $inscrip->encargado     = $request->encargado;
        $inscrip->contacto      = $request->telencargado;
        $inscrip->comentario      = $request->otro;
        $inscrip->nombre        = $item->nombre;
        $inscrip->apellido      = $item->apellido;
        $inscrip->codigo        = $item->codigo;
        $inscrip->codigo        = $item->nacimiento;
        $inscrip->registrador   = Auth::User()->idusuario;
        $inscrip->idinstitucion = Auth::User()->institucion->idinstitucion;
        $inscrip->idestado      = 1;
        $inscrip->resultado     = 2;
        //return $inscrip;
        $inscrip->save();
        //return $inscrip;
        $response = array(
            "message" => "true",
            "title"   => "Exito",
            "body"    => "El alumno ha sido inscrito exitosamente",
            "type"    => "success",
            "usuario" => $inscrip,

        );
        return $response;

    }
}
