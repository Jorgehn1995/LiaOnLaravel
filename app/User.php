<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="Usuarios";
    protected $primaryKey="idusuario";
    protected $fillable = [
        'nombre','apellido', 'usuario','idtipousuario', 'genero', 'nacimiento'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function informaciones(){
        return $this->hasMany('App\Informacion');
    }

    public function tipo(){
        return $this->belongsTo('App\TipoUsuario','idtipousuario');
    }
    public function institucion(){
        return $this->belongsTo('App\Institucion','idinstitucion');
    }
}
