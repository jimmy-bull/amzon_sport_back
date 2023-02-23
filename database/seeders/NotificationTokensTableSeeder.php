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
                'created_at' => '2022-12-29 15:55:37',
                'email' => 'jbull635@gmail.com',
                'id' => 23,
                'token' => 'ExponentPushToken[QjBjJkMRAWovEu6e0OV_un]',
                'updated_at' => '2023-01-10 21:50:59',
            ),
            1 => 
            array (
                'created_at' => '2022-12-30 15:47:25',
                'email' => 'Jamal@gmail.com',
                'id' => 24,
                'token' => 'ExponentPushToken[1NjJFBPW79lu6H0S_e3Qtx]',
                'updated_at' => '2023-01-19 18:17:49',
            ),
            2 => 
            array (
                'created_at' => '2023-01-04 19:08:42',
                'email' => 'jbull635@gmail.com',
                'id' => 25,
                'token' => 'ExponentPushToken[Dzb7cDEdxyehhTPqSO0YCM]',
                'updated_at' => '2023-01-11 22:20:33',
            ),
            3 => 
            array (
                'created_at' => '2023-01-05 09:16:54',
                'email' => 'jbull635@gmail.com',
                'id' => 26,
                'token' => 'ExponentPushToken[ie7kYLPNpSNACQcbGfASYL]',
                'updated_at' => '2023-01-11 15:36:36',
            ),
            4 => 
            array (
                'created_at' => '2023-01-07 12:06:29',
                'email' => 'jbull635@gmail.com',
                'id' => 27,
                'token' => 'undefined',
                'updated_at' => '2023-01-10 13:16:57',
            ),
            5 => 
            array (
                'created_at' => '2023-01-11 22:10:23',
                'email' => 'Jamal@gmail.com',
                'id' => 28,
                'token' => 'ExponentPushToken[306vpmF-m97nP98saABqG1]',
                'updated_at' => '2023-01-11 22:10:23',
            ),
            6 => 
            array (
                'created_at' => '2023-01-12 17:48:03',
                'email' => 'jbull635@gmail.com',
                'id' => 29,
                'token' => 'ExponentPushToken[OGqEotCt9VCkjiepwOjZ1D]',
                'updated_at' => '2023-01-12 19:19:44',
            ),
            7 => 
            array (
                'created_at' => '2023-01-12 19:58:24',
                'email' => 'jbull635@gmail.com',
                'id' => 30,
                'token' => 'ExponentPushToken[zY7MB0HRbXl895nnfaq7_B]',
                'updated_at' => '2023-01-12 19:59:59',
            ),
            8 => 
            array (
                'created_at' => '2023-01-15 20:58:35',
                'email' => 'Jamal@gmail.com',
                'id' => 31,
                'token' => 'ExponentPushToken[wd0lXZF3vqJaxddjbP6jFU]',
                'updated_at' => '2023-01-16 19:38:58',
            ),
            9 => 
            array (
                'created_at' => '2023-01-17 18:17:43',
                'email' => 'jbull635@gmail.com',
                'id' => 32,
                'token' => 'ExponentPushToken[aDDZ_RD4hx0bBvrDVifmV3]',
                'updated_at' => '2023-01-17 19:02:52',
            ),
            10 => 
            array (
                'created_at' => '2023-01-19 12:40:48',
                'email' => 'Jamal@gmail.com',
                'id' => 33,
                'token' => 'ExponentPushToken[mJC0NrKALYO0u3TKo77KFX]',
                'updated_at' => '2023-01-19 13:06:40',
            ),
            11 => 
            array (
                'created_at' => '2023-01-19 16:02:19',
                'email' => 'jbull635@gmail.com',
                'id' => 34,
                'token' => 'ExponentPushToken[MrPWIxLK8zFrffXLpJmNHn]',
                'updated_at' => '2023-01-19 18:17:54',
            ),
        ));
        
        
    }
}