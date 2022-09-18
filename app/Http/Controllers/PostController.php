<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function __invoke($slug)
    {
        
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return abort(404);
        }


        return view('posts.index', [
        
            'post' => $post,
        ]);
    }

}
