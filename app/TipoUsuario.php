<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    //
    //
    protected $table = "TiposUsuarios";
    protected $primaryKey="idtipousuario";
    protected $fillable =['tipo','ruta'];
    public function usuario(){
        return $this->hasMany('App\User','idtipousuario');
    }
    
}
