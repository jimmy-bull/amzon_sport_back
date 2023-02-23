<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PostTable;
use App\Models\ImageVideoTable;

class PostTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (PostTable $postTable) {
            ImageVideoTable::factory(1)->create([
                'post_id' => $postTable->id,
                'type' => "image",
                'link' => $this->faker->randomElement([
                    "public/post_images_videos/main_1.jpeg",
                    "public/post_images_videos/barssa.jpg",
                    "public/post_images_videos/barsa.jpg"
                ]),
            ]);


            // Users_Profile_Photo, FollowingSystem public/profils_photos/profil_main.jpeg
        });
    }
}
