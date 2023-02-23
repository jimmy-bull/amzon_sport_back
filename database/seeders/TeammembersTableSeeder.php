<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeammembersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teammembers')->delete();
        
        \DB::table('teammembers')->insert(array (
            0 => 
            array (
                'created_at' => '2023-01-16 19:21:45',
                'id' => 94,
                'notifications_id' => 679,
                'status' => 'exit',
                'team_to_join' => 'jamal hand',
                'team_to_join_owner' => 'Jamal@gmail.com',
                'updated_at' => '2023-01-16 19:24:40',
                'who_want_to_join' => 'jbull635@gmail.com',
            ),
        ));
        
        
    }
}