<?php
namespace Database\Factories;

use App\Models\Bundle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BundleFactory extends Factory
{
    protected $model = Bundle::class;

    public function definition()
    {
        $name = $this->faker->sentence(5);
        $placeholder = ['placeholder-1.jpg', 'placeholder-2.jpg', 'placeholder-3.jpg'];
        return [
            'title' => $name,
            'category_id' => rand(1, 10),
            'slug' => Str::slug($name),
            'course_image' => $placeholder[rand(0, 2)],
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 199),
            'featured' => Arr::random([0, 1]),
            'trending' => Arr::random([0, 1]),
            'popular' => Arr::random([0, 1]),
            'published' => 1,
        ];
    }
}

