<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $name = $this->faker->word;
        $icon = [
            'fab fa-accessible-icon',
            'fab fa-accusoft',
            'fas fa-address-book',
            'far fa-address-card',
            'fas fa-adjust',
            'fab fa-adn',
            'fab fa-adversal',
            'fab fa-affiliatetheme',
            'fab fa-algolia',
            'fas fa-allergies',
            'fab fa-amazon',
            'fab fa-amazon-pay',
            'fas fa-ambulance',
        ];

        return [
            'name' => $name,
            'slug' => str_slug($name),
            'status' => 1,
            'icon' => $this->faker->randomElement($icon),
        ];
    }
}
