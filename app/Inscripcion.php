<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table="Inscripciones";
    protected $primaryKey="idinscripcion";
    protected $fillable = [
        'idusuario','idgrado', 'idseccion', 'clave','ciclo','resultado','comentario','idestado','idinstitucion','encargado','contacto','direccion','nombre','apellido','foto','codigo','registrador','actualizador','nacimiento'
    ];

    public function usuario(){
        return $this->belongsTo('App\User','idusuario');
    }
    public function grado(){
        return $this->belongsTo("App\Grado","idgrado");
    }
    public function usuarios(){
        return $this->belongsTo('App\User','idusuario');
    }
    public function estado(){
        return $this->belongsTo('App\Estado','idestado');
    }
    public function seccion(){
        return $this->belongsTo('App\Seccion','idseccion');
    }
}
