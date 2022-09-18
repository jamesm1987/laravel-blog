<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CategoryController extends Controller
{

    public function __invoke($category_slug)
    {
        
        $slugParts  = explode('/', $category_slug);
        $categorySlug = array_pop($slugParts);
        
        $category = Category::where('slug', $categorySlug)->with('ancestors')->get();
        
        $slugs = $category->map(function ($item) {

            return [
                'category_slug' => $item->slug,
                'ancestors'  => $item->ancestors->map(function ($ancestor){
                    return [
                        'slug'   => $ancestor->slug,
                    ];
                })->pluck('slug')->all()
            ];
          });
        
        $slugs = Arr::collapse($slugs);
          
        if ( !empty($slugParts) && $category->first()->ancestors->isEmpty() ) {
            return redirect(404);
        }
          
          if (empty($slugs) || $categorySlug !== $slugs['category_slug']) {
             return redirect(404);
          }

          foreach (array_reverse($slugs['ancestors']) as $key => $ancestor) {
                if ($ancestor !== $slugParts[$key]) {
                    return redirect(404);
                }
          }

        return view('category.index', [
            'category' => $category->first()
        ]);
    }

}
