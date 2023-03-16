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
                'created_at' => '2023-03-15 20:43:17',
                'id' => 98,
                'notifications_id' => 735,
                'status' => 'accepeted',
                'team_to_join' => 'Jimmybase',
                'team_to_join_owner' => 'jbull635@gmail.com',
                'updated_at' => '2023-03-15 20:43:32',
                'who_want_to_join' => 'thetrackmonster@gmail.com',
            ),
        ));
        
        
    }
}