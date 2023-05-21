<?php

namespace Database\Factories;

use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestFactory extends Factory
{
    protected $model = Test::class;

    public function definition()
    {
        $title = $this->faker->text(30);
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'description' => $this->faker->paragraph(10),
            'slug' => $slug,
            'published' => 1,
        ];
    }
}
