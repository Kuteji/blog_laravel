<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // desabilitamos la proteccion de asignacion masiva para guardar en campos especificos
    protected $guarded = [];
}
