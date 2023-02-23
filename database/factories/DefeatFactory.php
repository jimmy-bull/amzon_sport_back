<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Defeat;
use App\Models\TeamRate;

class DefeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Defeat::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'game_id' => 106,
            // 'score' => rand(1, 3),
            // 'score_2' => rand(4, 7),
            // 'looser_mail' => "Jamal@gmail.com",
            // 'looser_team' => "Jamal Foot",
            // "status" => "accepted"
        ];
    }
    // public function configure()
    // {
    //     return $this->afterCreating(function (Defeat $defeat) {
    //         TeamRate::factory(1)->create([
    //             'game_id' => $defeat->game_id,
    //             'wichteamrated' => $defeat->looser_team,
    //             'punctuality' => $this->faker->randomNumber(2, 4),
    //             'fair_play' => $this->faker->randomNumber(3, 5),
    //             'winner_team' => "Real Team",
    //             "status" => "accepted"
    //         ]);
    //     });
    // }
}  // Jamal Foot
