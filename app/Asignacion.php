<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = "asignaciones";
    protected $primaryKey ="idasignacion";
    protected $fillable = ['idprofesor','idasignatura','idseccion'];
    public $timestamps = false;
    public function asignatura(){
        return $this->belongsTo('App\Asignatura','idasignatura');
    }
}
