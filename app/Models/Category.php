<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'parent_id', 'meta_title', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function scopeParentCategories(Builder $query)
    {
        return $query->where('parent_id', 0);
    }

    public function slug(): Attribute
    {   

        if ( empty($value) ) {
            $value = $this->title;
        }

        return Attribute::make(
            get: fn ($value) => Str::slug($value),
        );
    }    
}
