<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_tokens')->delete();
        
        \DB::table('notification_tokens')->insert(array (
            0 => 
            array (
                'created_at' => '2023-03-15 19:54:52',
                'email' => 'jbull635@gmail.com',
                'id' => 51,
                'token' => 'ExponentPushToken[7wxobUMd6kjLDzpTU7QM0a]',
                'updated_at' => '2023-03-15 20:51:09',
            ),
            1 => 
            array (
                'created_at' => '2023-03-15 19:55:26',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 52,
                'token' => 'ExponentPushToken[IPBdciAMUGy2mlSo6ToVNo]',
                'updated_at' => '2023-03-15 20:51:50',
            ),
        ));
        
        
    }
}