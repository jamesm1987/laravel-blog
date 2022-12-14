<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren 
{
    public function scopeParents(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }
}

