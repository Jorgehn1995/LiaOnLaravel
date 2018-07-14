<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table="Inscripciones";
    protected $primaryKey="idinformacion";
    protected $fillable = [
        'idusuario','idgrado', 'idseccion', 'clave','ciclo'
    ];

    public function usuario(){
        return $this->belongsTo('App\User','idusuario');
    }
    
}
