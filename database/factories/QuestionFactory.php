<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $is_approved = rand(0,1);
        $has_admin_answered = rand(0,1);
        $subject_id = rand(1,5);
        $topic_id = rand(1,50);
        return [
            'user_id' => 2,
            'is_approved' => $is_approved,
            'has_admin_answered' => $has_admin_answered,
            'title' => $this->faker->text(),
            'subject_id' => $subject_id,
            'topic_id' => $topic_id,
            'details' => $this->faker->text().$this->faker->text().$this->faker->text().$this->faker->text(),
            'upvotes' => rand(5, 50),
            'downvotes' => rand(2, 20),
        ];
    }
}