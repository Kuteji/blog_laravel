<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        // pasamos la variable posts como parametro
        return view('admin.posts.index', compact('posts'));
    }

    // public function create()
    // {
    //     $categories = Category::all();
    //     $tags = Tag::all();

    //     return view('admin.posts.create', compact('categories','tags'));
    // }

    public function store(Request $request)
    {
        // hacemos requerido el campo
        $this->validate($request, ['title' => 'required']);

        //guardamos en la base de datos y asignamos a la variable
        $post = Post::create([
            'title' => $request->get('title'),
            'url' => Str::slug($request->get('title'))
        ]);

        // redireccionamos y mandamos post como parametro
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('categories','tags','post'));

    }

    public function update(Post $post, Request $request)
    {
        // return Post::create($request->all());
        // dd($request->get('tags'));

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'excerpt' => 'required',
            'tags' => 'required'
        ]);

        $post->title = $request->get('title');
        $post->url = Str::slug($request->get('title'));
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;// dejamos que carbon formatee la fecha para que no haya errores
        $post->category_id = $request->get('category');

        $post->save();

        // adjuntamos el valor del req a la columna
        $post->tags()->sync($request->get('tags'));

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicacion ha sido Guardada');
    }
}
