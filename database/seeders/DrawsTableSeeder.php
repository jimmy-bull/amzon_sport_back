<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DrawsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('draws')->delete();
        
        \DB::table('draws')->insert(array (
            0 => 
            array (
                'created_at' => '2023-03-15 18:40:01',
                'game_id' => 42143,
                'id' => 32,
                'mail' => 'jbull635@gmail.com',
                'score' => 3,
                'status' => 'accepted',
                'team' => 'Real Team',
                'updated_at' => '2023-03-15 18:40:16',
            ),
            1 => 
            array (
                'created_at' => '2023-03-15 18:40:01',
                'game_id' => 42143,
                'id' => 33,
                'mail' => 'thetrackmonster@gmail.com',
                'score' => 3,
                'status' => 'accepted',
                'team' => 'Trackfoot',
                'updated_at' => '2023-03-15 18:40:16',
            ),
        ));
        
        
    }
}