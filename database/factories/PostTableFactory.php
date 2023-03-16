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
            ImageVideoTable::factory(3)->create([
                'post_id' => $postTable->id,
                'type' => "image",
                'link' => $this->faker->randomElement([
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fprofils_photos%2Fcd4978a1-f2c3-4f69-b708-03ea90440fe1.jpg?alt=media&token=1125bcf9-c06d-4367-a662-d93ab4f60e63",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fprofils_photos%2F19d3f56b-604d-4b5c-81f7-64c53fda445f.jpg?alt=media&token=24ae6b2b-8947-4766-871c-d04835f1c740",
                    "https://firebasestorage.googleapis.com/v0/b/osport-storage.appspot.com/o/public%2Fprofils_photos%2F2209e45e-57d0-4d9e-b444-972f4e59cc0b.jpg?alt=media&token=a7a44d11-9a69-4e10-a80b-da000dff09db"
                ]),
            ]);


            // Users_Profile_Photo, FollowingSystem public/profils_photos/profil_main.jpeg
        });
    }
}
