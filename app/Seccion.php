<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    //
    protected $table = "secciones";
    protected $primaryKey="idseccion";
    protected $fillable =['letra','nombresec','aula','idgrado'];
    public $timestamps=false;
    public function grado(){
        return $this->belongsTo('App\Grado','idgrado');
    }
    public function informaciones(){
        return $this->hasMany('App\Informaciones');
    }
    public function asignaciones(){
        return $this->hasMany('App\Asignacion','idseccion');
    }
}
