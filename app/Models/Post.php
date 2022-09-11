<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'body',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function categories()
    {
    	return $this->belongsToMany(Category::class, 'post_categories');
    }    

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at');
    }

    public function status()
    {
        return $this->published_at ? 'Published' : 'Draft'; 
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
