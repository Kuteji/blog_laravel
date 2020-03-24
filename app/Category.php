<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Category extends Model
{
    protected $guarded = [];
    // cambiamos el filtrado de id por defecto en routes a foltrado por nombre
    public function getRouteKeyName()
    {
        return 'url';
    }

    //creamos la relacion posts categorias
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


      // mutador
      public function setNameAttribute($name)
      {
          $this->attributes['name'] = $name;
          $this->attributes['url'] = Str::slug($name);
      }
}
