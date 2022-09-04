<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $posts = Post::paginate(8);
        return view('home', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
}
