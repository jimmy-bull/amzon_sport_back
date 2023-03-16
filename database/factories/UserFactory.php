<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Users_Profile_Photo;
use App\Models\FollowingSystem;
use App\Models\PostTable;
use App\Models\Team;
use App\Models\AskGame;
use App\Models\phone;
use Illuminate\Support\Facades\DB;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->name(),
            'name_lastname' => $this->faker->name() . $this->faker->firstName(),
            'city' => $this->faker->city(),
            // "latitude" => $this->faker->latitude(),
            // "longitude" => $this->faker->longitude(),
            "latitude" => 49.18215994291596,
            "longitude" => -0.35024680743103365,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$v91eT4OXFaMtA1macO4G3Ov8uAigOTHpoilWAkHiWkCwagiQfoJb2', // password
            'remember_token' => Str::random(10),
            "country" => 'FRANCE',
            "speudo" => $this->faker->name(),
            "location" =>  DB::raw("POINT(" .  -0.35024680743103365 . ',' . 49.18215994291596 . ")")
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            Users_Profile_Photo::factory(1)->create([
                'email' => $user->email,
                'image' => $this->faker->randomElement([
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fprofils_photos%2F0f21fffd-5f76-4cb4-acdf-ed7fbb1aacf1.jpg?alt=media&token=d1e8ddd4-3315-45d6-bb2e-f68e6eb3871c",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fprofils_photos%2Ffaf7c953-8a6e-47eb-91f2-8a193106cb13.jpg?alt=media&token=d1b80ea1-da0e-4ac0-88b3-583149c9c512",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fprofils_photos%2Fea280841-15a5-4afc-a03d-f36bb4829fd4.jpg?alt=media&token=4a9ade31-0706-4ed9-b900-b8ea9ddc100e"
                ]),
            ]);
            FollowingSystem::factory(1)->create([
                'thefollower' =>  "jbull635@gmail.com",
                'thefollowed' => $user->email,
                'thefollowingState' => "isfollowing",
            ]);

            PostTable::factory(1)->create([
                'title' => $this->faker->text(30),
                'user_id' => $user->id,
                'who_can_see' => "monde",
                "status" => "online"
            ]); // créé aussi les images pour chaque post dans Le factory Postable


            Team::factory(1)->create([
                'team_name' => $this->faker->name(),
                'sport_name' => "Football",
                'city' => $this->faker->city(),
                'email' => $user->email,
                'logo' => $this->faker->randomElement([
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fteams_photos%2F00ed66a8-baeb-486c-ad14-e9cf1e7e1ef9.jpg?alt=media&token=7634d86a-2b77-4eab-93a7-1a2737cbd961",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fteams_photos%2F1bdf6e65-2c21-4b43-87fe-383e8237f1b5.jpg?alt=media&token=f2ac9a1d-0760-482a-ae3e-1c6e07437c2c",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fteams_photos%2F147cae9a-c612-4e2f-894a-7b186098fbab.jpg?alt=media&token=25b1b98b-ea68-48ea-be33-1763849fe3d0",
                ]),
                'cover' => $this->faker->randomElement([
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fteams_photos%2F00ed66a8-baeb-486c-ad14-e9cf1e7e1ef9.jpg?alt=media&token=7634d86a-2b77-4eab-93a7-1a2737cbd961",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fteams_photos%2F1bdf6e65-2c21-4b43-87fe-383e8237f1b5.jpg?alt=media&token=f2ac9a1d-0760-482a-ae3e-1c6e07437c2c",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fteams_photos%2F147cae9a-c612-4e2f-894a-7b186098fbab.jpg?alt=media&token=25b1b98b-ea68-48ea-be33-1763849fe3d0",
                ])
            ]); // Créé aussi une demande match pour chaque equipe gangner dans le TeamFactory
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
