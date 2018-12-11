<?php

namespace App\Http\Controllers;

use App\Autocompletado;
use App\Grado;
use App\Inscripcion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AlumnosController extends Controller
{
    public function inscritos()
    {
        $alumnos = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('ciclo', Auth::User()->institucion->ciclo)->orderBy('idinscripcion', 'DESC')->get();
        $alumnos->each(function ($alumnos) {
            $alumnos->fullname = $alumnos->nombre . " " . $alumnos->apellido;
            $alumnos->edad     = $this->edad($alumnos->nacimiento) . " años";
            $alumnos->grado;
            if (!$alumnos->foto) {
                $alumnos->foto = asset('images/app/user.jpg');
            }
            $alumnos->editar = route('alumnos.edit', $alumnos->idinscripcion);
        });
        return $alumnos;
    }
    public function autocompletado()
    {
        $alumnos = Autocompletado::get();
        return $alumnos;
    }
    public function grados()
    {
        $grados = Grado::where('idinstitucion', Auth::User()->idinstitucion)->orderBy('idnivel')->get();
        return $grados;
    }
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
            'codigo'     => 'required',
            'nombre'     => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido'   => 'required',
            'genero'     => 'required',
            'nacimiento' => 'required',
            'ciclo'      => 'required',
            'idgrado'    => 'required',
        ]);
        $username = $request->codigo;
        $usr      = User::where('usuario', $username)->where('idinstitucion', Auth::User()->idinstitucion)->count();
        if ($usr > 0) {
            $username = $username . $request->ciclo;
        }

        $usr = Inscripcion::where('codigo', $request->codigo)->where('idinstitucion', Auth::User()->idinstitucion)->where('ciclo', $request->ciclo)->count();
        if ($usr > 0) {
            $response['status'] = false;
            $response['title']  = "Alumno Existente";
            $response['msg']    = "El codigo $request->codigo ya se encuentra inscrito para el ciclo $request->ciclo";
            return $response;
        }
        /**
         * Aqui se registra la inscripcion
         */
        $process                = new Inscripcion($request->all());
        $process->contacto      = $request->telencargado;
        $process->genero        = $request->genero;
        $process->idestado      = 1;
        $process->idinstitucion = Auth::User()->idinstitucion;
        $process->registrador   = Auth::User()->idusuario;
        $process->actualizador  = Auth::User()->idusuario;
        $process->uniqid        = uniqid(Auth::User()->institucion->abr . "_");
        $process->comentario    = $request->otro;
        $process->save();

        /**
         * AQUI SE REGISTRA EL USUARIO
         */
        $usuario                = new User($request->all());
        $usuario->usuario       = $username;
        $ps                     = date("Y", strtotime($request->nacimiento));
        $usuario->password      = bcrypt($ps);
        $usuario->idtipousuario = 4;
        $usuario->idinstitucion = Auth::User()->idinstitucion;
        $usuario->codigo        = $request->codigo;
        $usuario->idinscripcion = $process->idinscripcion;
        $usuario->save();

        $response['status']  = true;
        $response['title']   = "Alumno Inscrito";
        $response['msg']     = "Se inscribio a $request->nombre $request->apellido para el ciclo $request->ciclo";
        $response['usuario'] = $usuario;
        return $response;
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

    public function edit($id)
    {
        $inscripcion = Inscripcion::find($id);

        if (!$inscripcion || $inscripcion->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error al procesar la solicitud ID de Institución $id")->important();
            return $this->index();
        }
        $grados = Grado::where("idinstitucion", "=", Auth::User()->idinstitucion)->orderBy('idnivel', 'ASC')->orderBy('seccion', 'ASC')->get();
        if (!$grados) {
            Flash::error("Error al procesar la solicitud: No existen Niveles Registrados")->important();
            return $this->index();
        }
        //dd($niveles);
        return view('admin.alumnos.editar')->with("inscripcion", $inscripcion)->with("grados", $grados);
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'codigo'     => 'required',
            'nombre'     => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido'   => 'required',
            'genero'     => 'required',
            'nacimiento' => 'required',
            'idgrado'    => 'required',

        ]);
        $inscripcion = Inscripcion::find($id);
        if (!$inscripcion || $inscripcion->idinstitucion != Auth::User()->idinstitucion) {
            Flash::error("Error al procesar la solicitud de actualización: ID de Institución $id")->important();
            return $this->index();
        }
        /** Se inicia la actualizacion de la tabla inscripciones */
        $comprobar = Inscripcion::where('idinstitucion', Auth::User()->idinstitucion)->where('codigo', $request->codigo)->where('idinscripcion', '!=', $inscripcion->idinscripcion)->count();
        if ($comprobar > 0) {
            Flash::error("El codigo ya pertenece a otro alumno")->important();
            return redirect()->route('alumnos.edit', $inscripcion->idinscripcion);
        }
        $inscripcion->codigo     = $request->codigo;
        $inscripcion->nombre     = $request->nombre;
        $inscripcion->apellido   = $request->apellido;
        $inscripcion->genero     = $request->genero;
        $inscripcion->nacimiento = $request->nacimiento;
        $inscripcion->idestado   = $request->idestado;
        $inscripcion->direccion  = $request->direccion;

        $inscripcion->idgrado    = $request->idgrado;
        $inscripcion->encargado  = $request->encargado;
        $inscripcion->contacto   = $request->telencargado;
        $inscripcion->comentario = $request->otro;

        $inscripcion->actualizador = Auth::User()->idusuario;
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

}
