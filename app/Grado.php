<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    //
    protected $table = "grados";
    protected $primaryKey ="idgrado";
    protected $fillable = ['orden','grado','idnivel'];
    public $timestamps = false;
    public function nivel(){
        return $this->belongsTo('App\Nivel','idnivel');
    }
    public function secciones(){
        return $this->hasMany('App\Seccion','idgrado');
    }
    public function asignaturas(){
        return $this->hasMany('App\Asignatura','idgrado')->orderBy('orden');;
    }
    public function inscripcion(){
        return $this->hasMany("App\Inscripcion","idgrado");
    }
}
