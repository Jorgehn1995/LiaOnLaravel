<?php

namespace App\Http\Controllers;

use App\Informacion;
use App\User;
use App\Grado;
use App\Inscripcion;
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
        $usuario = Informacion::where("codigo", "=", $id)->first();
        if (!$usuario) {
            return ("false");
        } else {
            return ($usuario->idusuario);
        }
    }
    public function index(){
        $alumnos=Inscripcion::with('estado')->where("idinstitucion","=",Auth::User()->institucion->idinstitucion)->get();
        //dd($alumnos);
        
        return view('admin.alumnos.index')->with("alumnos",$alumnos);
    }
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:informaciones',
            'nombre' => 'required', //'required|unique:posts|max:255|min:5|email'
            'apellido' => 'required',
            'genero' => 'required',
            'nacimiento' => 'required',
        ]);
        //dd($request->all());
        $item = new User($request->all());
        $item->usuario = $request->codigo;
        $ps = date("Y", strtotime($request->nacimiento));
        $item->password = bcrypt($ps);
        $item->idtipousuario = 4;
        $item->idinstitucion = Auth::User()->institucion->idinstitucion;
        $item->save();
        $usuario = User::where("nombre", "=", $request->nombre)
            ->where("apellido", "=", $request->apellido)
            ->where("nacimiento", "=", $request->nacimiento)->first();
        //dd($usuario->idusuario);
        if (!$usuario) {
            Flash::error("Se ha producido un error al agregar la información del alumno")->important();
            return redirect()->route('alumnos.create');
        } else {
            $info = new Informacion($request->all());
            $info->idusuario = $usuario->idusuario;
            $info->save();
            Flash::success("El alumno $request->nombre $request->apellido ha sido agregado exitosamente ")->important();
            return $this->inscripcion($usuario->idusuario);
            //return redirect()->route('alumnos.create');
        }

    }
    public function inscripcion($id)
    {
        $usuario = User::find($id);
        $usuario->edad = $this->edad($usuario->nacimiento);
        $usuario->pass = date("Y", strtotime($usuario->nacimiento));
        $usuario->direccion = ($usuario->direccion == "") ? "No Registrada" : $usuario->direccion;
        $usuario->generol = ($usuario->genero == "M") ? "Masculino" : "Femenino";
        $usuario->y = date("Y");
        /** se comprueba que no este inscrito en el establecimiento */
        $ciclo=date("Y");
        $inscripcion=Inscripcion::where("idinstitucion","=",Auth::User()->institucion->idinstitucion)->where("idusuario","=",$usuario->idusuario)->where("ciclo","=",$ciclo)->first();
        if($inscripcion){
            Flash::success("El alumno ya se encuentra registrado en el ciclo escolar $ciclo ")->important();
            return redirect()->route('alumnos.comprobante',['idinscripcion' => $inscripcion->idinscripcion]);
            //return $this->comprobante($request->idusuario);
        }

        /** se reunen y buscan los grados */
        $idinstitucion = Auth::User()->idinstitucion;
        $grados = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'ASC')
            ->paginate(10);
        return view('admin.alumnos.inscripcion')->with("usuario", $usuario)->with("grados",$grados);
    }
    public function comprobante($id)
    {
        $comprobante=Inscripcion::find($id);
        $usuario = User::find($comprobante->usuario->idusuario);
        $usuario->edad = $this->edad($usuario->nacimiento);
        $usuario->pass = date("Y", strtotime($usuario->nacimiento));
        $usuario->direccion = ($usuario->direccion == "") ? "No Registrada" : $usuario->direccion;
        $usuario->generol = ($usuario->genero == "M") ? "Masculino" : "Femenino";
        $usuario->y = date("Y");
        /** se reunen y buscan los grados */
        $idinstitucion = Auth::User()->idinstitucion;
        $grados = Grado::join('niveles', 'grados.idnivel', '=', 'niveles.idnivel')
            ->where('niveles.idinstitucion', '=', "$idinstitucion")
            ->orderBy('niveles.idnivel', 'ASC')
            ->orderBy('grados.orden', 'ASC')
            ->paginate(10);
        return view('admin.alumnos.comprobante')->with("inscripcion", $comprobante);
    }
    public function edad($fecha)
    {
        list($ano, $mes, $dia) = explode("-", $fecha);
        $ano_diferencia = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0) {
            $ano_diferencia--;
        }
        return $ano_diferencia;
    }
    public function inscribir(Request $request){
        //dd($request->all());
        $request->validate([
            'idusuario' => 'required',
            'idgrado' => 'required', //'required|unique:posts|max:255|min:5|email'
        ]);
        $ciclo=date("Y");
        $inscripcion=Inscripcion::where("idinstitucion","=",Auth::User()->institucion->idinstitucion)->where("idusuario","=",$request->idusuario)->where("ciclo","=",$ciclo)->first();
        if($inscripcion){
            Flash::error("El alumno ya se encuentra registrado en el ciclo escolar $ciclo ")->important();
            return redirect()->route('alumnos.comprobante',['idinscripcion' => $inscripcion->idinscripcion]);
            //return $this->comprobante($request->idusuario);
        }else{
            $inscrip=new Inscripcion($request->all());
            $inscrip->ciclo=$ciclo;
            $inscrip->idinstitucion=Auth::User()->institucion->idinstitucion;
            $inscrip->idestado=1;
            $inscrip->resultado=2;
            $inscrip->save();
            $inscripcion=Inscripcion::where("idinstitucion","=",Auth::User()->institucion->idinstitucion)->where("idusuario","=",$request->idusuario)->where("ciclo","=",$ciclo)->first();
            Flash::success("El alumno se inscribió al ciclo escolar $ciclo satisfactoriamente")->important();
            return $this->comprobante($inscripcion->idinscripcion);
        }
    }
}
