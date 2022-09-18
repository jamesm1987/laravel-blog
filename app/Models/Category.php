<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasChildren;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;


use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasChildren, HasRecursiveRelationships;

    protected $fillable = ['title', 'parent_id', 'meta_title', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function slug(): Attribute
    {   

        return Attribute::make(
            get: fn ($value) => Str::slug($value),
            set: fn($value) => empty($value) ? Str::slug($this->title) : Str::slug($value)
        );
    }
    
    public function category_path()
    {
        $path = '';

        if ($this->parent_id != NULL) {
            $ancestors = $this->ancestors()->get()->reverse();
            
            foreach ($ancestors as $ancestor) {
                $path .= $ancestor->slug . '/';
            }

            $path .= $this->slug;
        
        } else {
            $path = $this->slug;
        
        }

        return $path;
    
    }
}
