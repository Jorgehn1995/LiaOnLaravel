<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horario";
    protected $primaryKey ="idhorario";
    protected $fillable = ['dia','inicio','fin','idasignacion'];
    public $timestamps = false;
}
