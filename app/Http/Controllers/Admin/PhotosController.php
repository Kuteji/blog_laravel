<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {

        $this->validate(request(),[
            'photo' => 'required|image|max:2048' 
        ]);

        /* la ruta por defaul donde store guarda los archivos
        en app storage */ 

         // crea la carpeta y almacena la imagen
        $photo = request()->file('photo')->store('public'); 
        
        /* se debe desabilitar la proteccion de asignacion masiva
        para poder gurdar de este modo en db*/
        Photo::create([
            'url' => Storage::url($photo),
            'post_id' => $post->id 
        ]);

    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        $photopath = str_replace('storage', 'public', $photo->url);

        Storage::delete($photopath);

        return back()->with('flash', 'Foto eliminada');
    }
}
