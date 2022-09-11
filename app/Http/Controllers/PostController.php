<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function __invoke($category, $slug)
    {
    
        $post = Post::where('slug', $slug)->first();

        return view('posts.index', [
        
            'post' => $post,
        ]);
    }

}
