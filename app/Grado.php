<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    //
    protected $table      = "grados";
    protected $primaryKey = "idgrado";
    protected $fillable   = ['orden', 'grado', 'idinstitucion', 'seccion', 'nombre', 'corto', 'idrol'];
    public $timestamps    = false;

    public function secciones()
    {
        return $this->hasMany('App\Seccion', 'idgrado');
    }
    public function asignaturas()
    {
        return $this->hasMany('App\Asignatura', 'idgrado')->orderBy('orden');
    }
    public function inscripcion()
    {
        return $this->hasMany("App\Inscripcion", "idgrado");
    }
    public function asesor()
    {
        return $this->belongsTo("App\Rol", "idrol");
    }
    
}
