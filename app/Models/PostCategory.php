<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Pivot
{
    protected $table = 'post_categories';
}
