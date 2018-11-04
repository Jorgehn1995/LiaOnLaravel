<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estados";
    protected $primaryKey ="idestado";
    protected $fillable = ['estado','color'];
    public $timestamps = false;
    public function inscripcion(){
        return $this->hasMany('App\Inscripcion','idestado');
    }
    
}
