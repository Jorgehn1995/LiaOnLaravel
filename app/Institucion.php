<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = "Instituciones";
    protected $primaryKey="idinstitucion";
    protected $fillable = ['nombre','abr','lema','direccion','telefono','correo','url','logo','logodoc'];

    public function niveles(){
        return $this->hasMany('App\Nivel');
    }
    public function usuario(){
        return $this->hasMany('App\User','idinstitucion');
    }
    public function administradores(){
        return $this->hasMany('App\Administrador','idinstitucion');
    }
}
