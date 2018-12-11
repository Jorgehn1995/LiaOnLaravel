<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autocompletado extends Model
{
    protected $table      = "Alumnos";
    protected $primaryKey = "idalumno";
    public $timestamps = false;
    protected $fillable   = [
        'codigo',
        'nombre',
        'apellido',
        'genero',
        'nacimiento',
        'direccion',
        'telefono',
        'correo',
    ];

    
}
