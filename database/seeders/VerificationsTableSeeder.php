<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VerificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('verifications')->delete();
        
        \DB::table('verifications')->insert(array (
            0 => 
            array (
                'created_at' => '2023-01-19 16:44:24',
                'email' => 'jbull635@gmail.com',
                'id' => 57,
                'updated_at' => '2023-01-19 16:44:24',
                'verification_code' => '9837',
                'verification_code_end' => '2023-01-19 17:14:24',
            ),
            1 => 
            array (
                'created_at' => '2023-01-19 16:51:33',
                'email' => 'jbull635@gmail.com',
                'id' => 58,
                'updated_at' => '2023-01-19 16:51:33',
                'verification_code' => '1518',
                'verification_code_end' => '2023-01-19 17:21:33',
            ),
        ));
        
        
    }
}