<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuadro extends Model
{
    protected $table = "cuadros";
    protected $primaryKey ="idcuadro";
    protected $fillable = ['nombre','descripcion','ponderacion','autoagregar','idnivel','orden'];
    public $timestamps = false;
    public function nivel(){
        return $this->belongsTo('App\Nivel','idnivel');
    }
    public function modelos(){
        return $this->hasMany('App\Modelo','idcuadro')->orderBy('orden');
    }
    
}
