<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = "asesores";
    protected $primaryKey="idasesor";
    protected $fillable =['idusuario','idseccion'];
    public $timestamps=false;
    
}
