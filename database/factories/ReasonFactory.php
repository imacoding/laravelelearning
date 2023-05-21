<?php

namespace Database\Factories;

use App\Models\Reason;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReasonFactory extends Factory
{
    protected $model = Reason::class;

    public function definition()
    {
        $title = $this->faker->sentence(5);
        $content = $this->faker->paragraph(2);
        $icon = [
            'fab fa-accessible-icon',
            'fab fa-accusoft' ,
            'fas fa-address-book' ,
            'far fa-address-card' ,
            'fas fa-adjust',
            'fab fa-adn',
            'fab fa-adversal',
            'fab fa-affiliatetheme' ,
            'fab fa-algolia' ,
            'fas fa-allergies',
            'fab fa-amazon',
            'fab fa-amazon-pay',
            'fas fa-ambulance',
        ];

        return [
            'title' => $title,
            'content' => $content,
            'icon' => $this->faker->randomElement($icon),
            'status' => 1,
        ];
    }
}
