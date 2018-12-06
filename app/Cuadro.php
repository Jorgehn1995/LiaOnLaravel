<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuadro extends Model
{
    protected $table      = "cuadros";
    protected $primaryKey = "idcuadro";
    protected $fillable   = ['nombre', 'descripcion', 'punteo', 'orden', 'renombrar', 'asesor', 'actividad', 'idinstitucion', 'idsaber', 'saber'];
    public $timestamps    = false;
    public function actividades()
    {
        return $this->hasMany('App\Actividad', 'idcuadro')->orderBy('orden');
    }
}
