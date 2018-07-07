<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = "modelos";
    protected $primaryKey ="idmodelo";
    protected $fillable = ['idcuadro','nombre','descripcion','orden','enclase','punteo','renombrar','asesor'];
    public $timestamps = false;
    public function nivel(){
        return $this->belongsTo('App\Nivel','idnivel');
    }
    public function cuadro(){
        return $this->belongsTo('App\Cuadro','idcuadro');
    }
    public function niveles(){
        return $this->hasManyThrough(Nivel::class, Cuadro::class, 'idcuadro', 'idnivel');
    }
}
