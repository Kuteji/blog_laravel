<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

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
        $post = Post::create($request->only('title'));

        // redireccionamos y mandamos post como parametro
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('categories','tags','post'));

    }

    public function update(Post $post, StorePostRequest $request)
    {

        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = $request->get('published_at');
        $post->category_id = $request->get('category_id');
        $post->save();

        // $post->update($request->except('tags'));


        $post->syncTags($request->get('tags'));

       

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicacion ha sido Guardada');
    }
}
