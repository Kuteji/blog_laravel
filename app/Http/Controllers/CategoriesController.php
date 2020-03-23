<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {

        // retorna los de la relacion posts definida en el modelo
        return view('welcome', [
            'category' => $category,
            'posts' => $category->posts()->paginate()
        ]);
    }
}
