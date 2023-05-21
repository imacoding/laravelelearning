<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        $name = $this->faker->text(50);
        return [
            'title' => $name,
            'slug' => Str::slug($name),
            'content' => $this->faker->text(1000),
            'category_id' => rand(1,10),
            'user_id' => 1,
        ];
    }
}
