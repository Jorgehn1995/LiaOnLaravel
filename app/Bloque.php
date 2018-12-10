<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    protected $table      = "bloques";
    protected $primaryKey = "idbloque";
    protected $fillable   = ['bloque', 'nombre', 'porcentaje', 'profesor', 'alumno', 'padre', 'inicio', 'fin', 'auto', 'modificacion', 'eliminado'];
    public $timestamps    = false;

}
