<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = "asignaciones";
    protected $primaryKey ="idasignacion";
    protected $fillable = ['idusuario','idasignatura','idseccion'];
    public $timestamps = false;
    public function asignatura(){
        return $this->belongsTo('App\Asignatura','idasignatura');
    }
    public function profesores(){
        return $this->hasMany('App\User','idusuario');
    }
    public function profesor(){
        return $this->belongsTo('App\User','idusuario');
    }
    public function seccion(){
        return $this->belongsTo('App\Seccion','idseccion');
    }
    public function cargos(){
        return $this->hasMany('App\Cargo','idasignacion');
    }
}
