<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table      = "asignaturas";
    protected $primaryKey = "idasignatura";
    protected $fillable   = ['idgrado', 'idrol', 'nombre', 'corto', 'estado', 'orden', 'bloqueunico', 'eliminado'];
    public $timestamps    = false;
    public function grado()
    {
        return $this->belongsTo('App\Grado', 'idgrado');
    }
    public function asignaciones()
    {
        return $this->hasMany('App\Asignacion', 'idasignatura');
    }
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'idrol');
    }
}
