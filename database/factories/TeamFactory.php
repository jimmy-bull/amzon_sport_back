<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\AskGame;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'team_name' => $this->faker->firstName(),
            // 'sport_name' => $this->faker->lastName(),
            // 'city' => $this->faker->city(),
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'logo' => $this->faker->randomElement([
            //     "public/teams_photos/barc.jpg",
            //     "public/teams_photos/mars.png",
            //     "public/teams_photos/paris.jpg",
            //     "public/teams_photos/paris_2.jpg"
            // ]),
            // 'cover' => "public/teams_photos/IPhHmyyQ06SSNgsGvEbCq9NcufYA5cO4RxDB2YnQ.jpg"

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Team $team) {
            AskGame::factory(1)->create([
                "who_is_asking" => "jbull635@gmail.com",
                "who_was_asked" => $team->email,
                'date_of_game' => $this->faker->dateTimeBetween("2023-01-01 16:30:18", "2023-02-02 16:30:18"),
                "hours_of_game" => "19h30",
                "place_of_game" => $this->faker->city(),
                "team_of_asker" => "Real Team",
                "team_of_who_was_asked" => $team->team_name,
                "status" => "finish"
            ]);
        }); // Cree aussi dans les table winnings et defeats des score dans le ASKGAmesFactory
    }
}
