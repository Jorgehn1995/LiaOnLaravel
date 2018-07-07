<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = "asignaturas";
    protected $primaryKey ="idasignatura";
    protected $fillable = ['orden','nombre','corto','idgrado'];
    public $timestamps = false;
    public function grado(){
        return $this->belongsTo('App\Grado','idgrado');
    }
}
