<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition()
    {
        $question = $this->faker->sentence($nbWords = 6, $variableNbWords = true) . '?';
        $answer = $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true);
        
        return [
            'category_id' => $this->faker->numberBetween(1, 6),
            'question' => $question,
            'answer' => $answer,
        ];
    }
}
