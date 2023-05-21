<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        $name = $this->faker->sentence(5);
        $placeholder = ['placeholder-1.jpg', 'placeholder-2.jpg', 'placeholder-3.jpg'];

        return [
            'title' => $name,
            'category_id' => rand(1,10),
            'slug' => str_slug($name),
            'course_image' => $placeholder[rand(0,2)],
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 199),
            'featured' => $this->faker->randomElement([0,1]),
            'trending' => $this->faker->randomElement([0,1]),
            'popular' => $this->faker->randomElement([0,1]),
            'published' => 1,
        ];
    }
}
