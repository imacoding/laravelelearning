<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionsOption;

class QuestionsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::factory()->count(500)->create();

        if ($questions) {
            $questions->each(function ($question) {
                $options = QuestionsOption::factory()->count(4)->make()->toArray();
                $question->options()->createMany($options);
                $question->tests()->attach(rand(1, 100));
            });
        }
    }
}
