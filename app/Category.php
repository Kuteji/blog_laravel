<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // cambiamos el filtrado de id por defecto en routes a foltrado por nombre
    public function getRouteKeyName()
    {
        return 'name';
    }

    //creamos la relacion posts categorias
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
