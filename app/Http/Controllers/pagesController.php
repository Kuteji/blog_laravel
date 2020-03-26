<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function home ()
    {
       
        // $posts = Post::published()->get();
        //pos defecto los pagina de 15 en 15
        // $posts = Post::published()->simplePaginate(1);
        $posts = Post::published()->paginate();

        // pasamos los posts como parametro a la ruta
        return view('pages.home',compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        return view('pages.archive');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
