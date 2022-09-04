<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $post_title = fake()->sentence;
        return [
            'title' => $post_title,
            'slug' => Str::slug($post_title),
            'body' => fake()->paragraphs(5, true),
            'published_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ];
    }
}
