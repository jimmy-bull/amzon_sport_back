<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subcomments;

class SubcommentsFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcomments::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "comment_id" => 5,
            "comments" => 'commment pour on s\'enfou 2 partie',
            "who_commented_id" => 26,
            "main_comment_id" => 1,
        ];
    }
}
