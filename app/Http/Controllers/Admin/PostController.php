<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['categories', 'tags'])->get();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        
        $categories = Category::parents()->with('children')->get();
    
        $tags = Tag::pluck('title', 'id');
        
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreatePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $request = $request->except('_token');
        $request['user_id'] = Auth::user()->id;
        $post = Post::create($request);

        if ( !empty($request['categories']) ) {
            $categories = explode(',', $request['categories'][0]);
            $this->syncToPost($post, Category::class, 'categories', $categories);
        }

        if ( !empty($request['tags']) ) {
            $tags = explode(',', $request['tags'][0]);
            $this->syncToPost($post, Tag::class, 'tags', $tags);
        }

        if ($request['action'] === 'publish') {
            $request['published_at'] = Carbon::now();
        }      
        
        return redirect()->route('admin.posts.index')->with('status', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $postCategories = $post->categories->map(function ($category) {
            return $category->id;
        })->toArray();
        
        $postTags = $post->tags->map(function ($tag) {
            return $tag->id;
        })->toArray();

        $categories = Category::parentCategories()->with('children')->get();

        $tags = Tag::pluck('title', 'id');
        
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'postCategories' => $postCategories,
            'postTags' => $postTags,            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request = $request->all();
        if ($request['action'] === 'publish') {
            $request['published_at'] = Carbon::now()->toDateTimeString();
        }
        
        $post->update($request);

        
        $categories = empty($request['categories'][0]) ? [] : explode(',', $request['categories']);
        
        $this->syncToPost($post, Category::class, 'categories', $categories);

        $tags = empty($request['tags'][0]) ? [] : explode(',', $request['tags']);
        $this->syncToPost($post, Tag::class, 'tags', $tags);

        return redirect()->route('admin.posts.index')->with('status', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    private function syncToPost(Post $post, $syncModel, $associate, array $toSync)
    {
        foreach ($toSync as $key => $item) {
            if ( !is_numeric($item) ) {
                $newItem = $syncModel::create(['title' => $item->title]);
                $toSync[$key] = $newItem->id;
            }
            
        }

        $post->$associate()->sync($toSync);
    }
}
