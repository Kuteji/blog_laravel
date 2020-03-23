<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // deshabilitamos la proteccion de asignacion masiva
    protected $guarded = [];

    // convertimos a una instancia de carbon para poder usar los metodos de fechas
    protected $dates = ['published_at'];




    // sobreescribimos el metodo que obtiene la llave de la rura
    public function getRouteKeyName()
    {
        // retornamos la url del campo  que mandamos como parametro
        return 'url';
    }



    public function category() // $post->category->name
    {
        return $this->belongsTo(Category::class); //pertenece a...
    }

    public function tags() // $post->category->name
    {
        return $this->belongsToMany(Tag::class); //pertenece a...
    }

    // crear la relacion de uno a muchos para las fotos
    public function photos()
    {
        return $this->hasMany(Photo::class);//un post puede tener varias fotos
    }

    // query scope
    public function scopePublished( $query)
    {
         // asignamos los post por fecha de creacion en orden descendente
         $query->whereNotNull('published_at') // donde las fechas no sean nulas
                ->where('published_at', '<=', Carbon::now() ) // donde las fechas no sean myores a la fecha actual
                ->latest('published_at');        
    }

}
