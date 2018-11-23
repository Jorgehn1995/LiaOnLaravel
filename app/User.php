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
       'idusuario', 'nombre','apellido', 'usuario','idtipousuario', 'genero', 'nacimiento', 'socialname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function roles(){
        return $this->hasMany('App\Rol','idusuario');
    }
    public function informaciones(){
        return $this->hasOne('App\Informacion','idusuario');
    }
    public function inscripciones(){
        return $this->hasMany('App\Inscripcion','idusuario');
    }
    public function inscripcion(){
        return $this->belongsTo('App\Inscripcion','idusuario');
    }
    public function tipo(){
        return $this->belongsTo('App\TipoUsuario','idtipousuario');
    }
    public function institucion(){
        return $this->belongsTo('App\Institucion','idinstitucion');
    }
    public function asignacion(){
        return $this->belongsTo('App\Asignacion','idusuario');
    }
    public function asignaciones(){
        return $this->hasMany('App\Asignacion','idusuario');
    }
    
}
