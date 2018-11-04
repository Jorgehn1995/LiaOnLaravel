<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = "administradores";
    protected $primaryKey ="idadministrador";
    protected $fillable = ['idusuario','idinstitucion'];
    public $timestamps = true;
    public function usuario(){
        return $this->belongsTo('App\User','idusuario');
    }
    public function institucion(){
        return $this->belongsTo('App\Institucion','idinstitucion');
    }
}
