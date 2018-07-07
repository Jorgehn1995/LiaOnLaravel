<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    //
    protected $table = "Niveles";
    protected $primaryKey="idnivel";
    protected $fillable =['nombre','corto','descripcion','idinstitucion'];
    public $timestamps = false;
    public function institucion(){
        return $this->belongsTo('App\Institucion');
    }
    public function grados(){
        return $this->hasMany('App\Grado','idnivel');
    }
    public function cuadros(){
        return $this->hasMany('App\Cuadro','idnivel');
    }
    public function modelos(){
        return $this->hasManyThrough(Modelo::class, Cuadro::class, 'idnivel', 'idcuadro');
    }
    public function secciones(){
        return $this->hasManyThrough(Seccion::class, Grado::class, 'idnivel', 'idgrado');
    }
    
}
