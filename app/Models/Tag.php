<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'meta_title', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function slug(): Attribute
    {   

        return Attribute::make(
            get: fn ($value) => Str::slug($value),
            set: fn($value) => empty($value) ? Str::slug($this->title) : Str::slug($value)
        );
    }
}
