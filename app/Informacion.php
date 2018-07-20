<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $table="Informaciones";
    protected $primaryKey="idinformacion";
    protected $fillable = [
        'codigo','encargado', 'telencargado', 'otro','idseccion','clave','idusuario'
    ];

    public function usuario(){
        return $this->belongsTo('App\User','idusuario');
    }
    public function secciones(){
        return $this->belongsTo('App\Seccion');
    }
}
