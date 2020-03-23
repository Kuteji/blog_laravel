<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        // return($id);
        // comentamos la linea de abajo dado que cambiamos el paramtro y de esa forma asignamos directamente el post filtrado por su id
        // $post = Post::find($post);

        return view('posts.show', compact('post'));
    }
}
