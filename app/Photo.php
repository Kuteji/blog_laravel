<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    // desabilitamos la proteccion de asignacion masiva para guardar en campos especificos
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($photo){
          
            $photoPath = str_replace('storage','public', $photo->url);
            Storage::delete($photoPath);
        });
    }
}
