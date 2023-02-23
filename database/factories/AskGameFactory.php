<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AskGame;
use App\Models\Winning;
use App\Models\Defeat;
use App\Models\TeamRate;

class AskGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AskGame::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // "who_is_asking" => "jbull635@gmail.com",
            // "who_was_asked" => "Jamal@gmail.com",
            // 'date_of_game' => $this->faker->dateTimeBetween("2022-11-22 11:30:18", "2022-12-22 11:30:18"),
            // "hours_of_game" => "19h30",
            // "place_of_game" => $this->faker->city(),
            // "team_of_asker" => "Real Team",
            // "team_of_who_was_asked" => "Jamal Foot",
            // "status" => "finish"
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (AskGame $askGame) {
            Winning::factory(1)->create([
                'game_id' => $askGame->id,
                'score' => 4,
                'score_2' => 2,
                'winner_mail' => "jbull635@gmail.com",
                'winner_team' => "Real Team",
                "status" => "accepted"
            ]);

            Defeat::factory(1)->create([
                'game_id' => $askGame->id,
                'score' => 2,
                'score_2' => 4,
                'looser_mail' => $askGame->who_was_asked,
                'looser_team' => $askGame->team_of_who_was_asked,
                "status" => "accepted"
            ]);
            TeamRate::factory(1)->create([
                'game_id' => $askGame->id,
                'wichteamrated' => $askGame->team_of_asker,
                'punctuality' => $this->faker->numberBetween(2, 4),
                'fair_play' => $this->faker->numberBetween(3, 5),
                'teamrated' => 0,
                'team_rated_name' => $askGame->team_of_who_was_asked,
                "status" => "accepted"
            ]);

            TeamRate::factory(1)->create([
                'game_id' => $askGame->id,
                'wichteamrated' => $askGame->team_of_who_was_asked,
                'punctuality' => $this->faker->numberBetween(3, 5),
                'fair_play' => $this->faker->numberBetween(4, 5),
                'teamrated' => 0,
                'team_rated_name' => $askGame->team_of_asker,
                "status" => "accepted"
            ]);
        });
    }
}

// 