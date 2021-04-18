<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $is_approved = rand(0,1);
        $is_correct_marked = rand(0,1);
        $question_id = rand(1,200);
        return [
            'user_id' => 2,
            'is_approved' => $is_approved,
            'is_correct_marked' => $is_correct_marked,
            'question_id' => $question_id,
            'answer' => $this->faker->text().$this->faker->text().$this->faker->text(),
            'upvotes' => rand(5, 50),
            'downvotes' => rand(2, 20),
        ];
    }
}