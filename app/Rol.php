<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table      = "roles";
    protected $primaryKey = "idrol";
    protected $fillable   = ['idusuario', 'idinstitucion', 'rol'];
    public $timestamps    = true;
    public function usuario()
    {
        return $this->belongsTo('App\User', 'idusuario');
    }
    public function institucion()
    {
        return $this->belongsTo('App\Institucion', 'idinstitucion');
    }
    public function grado()
    {
        return $this->hasMany('App\Grado', 'idrol');
    }
    public function asignaturas()
    {
        return $this->hasMany('App\Asignatura', 'idrol');
    }
}
