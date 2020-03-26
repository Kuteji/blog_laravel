<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    // deshabilitamos la proteccion de asignacion masiva
    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id'
    ];

    // convertimos a una instancia de carbon para poder usar los metodos de fechas
    protected $dates = ['published_at'];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post){
             // quitamos todas las etiquetas asignadas a este post
            $post->tags()->detach();
            //Eliminamos las fotos asociadas
            $post->photos->each->delete();
        });
    }


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

    // REESCRIBIENDO EL METODO CREATE
    public static function create(array $attributes = [])
    {
        // Devuelve el post recien creado
        $post = static::query()->create($attributes);

        $post->generateUrl();


        return $post;
    }

    public function generateUrl()
    {
        $url = Str::slug($this->title);

        if ($this->whereUrl($url)->exists()) {
           $url = "{$url}-{$this->id}";
        }


        $this->url = $url;

        $this->save();
    }

    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;
        
    //     $originalUrl =  $url = Str::slug($title);
    //     $count = 1;

    //     while ( Post::where('url', $url)->exists() ) {
    //         $url = "{$originalUrl}-" . ++$count;
    //     }

    //     $this->attributes['url'] = $url;
    // }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;// dejamos que carbon formatee la fecha para que no haya errores
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
                                    ? $category
                                    : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

          // adjuntamos el valor del req a la columna
          return $this->tags()->sync($tagIds);
    }

}
