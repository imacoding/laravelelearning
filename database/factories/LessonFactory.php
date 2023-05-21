<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        $name = $this->faker->sentence(8);

        return [
            'title' => $name,
            'slug' => str_slug($name),
            'short_text' => $this->faker->paragraph(),
            'full_text' => $this->faker->text(1000),
            'position' => rand(1, 10),
            'free_lesson' => 1,
            'published' => rand(0, 1),
        ];
    }
}
