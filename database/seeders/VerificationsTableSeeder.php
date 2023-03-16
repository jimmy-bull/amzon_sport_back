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
            2 => 
            array (
                'created_at' => '2023-01-29 10:01:28',
                'email' => 'jbull635@gmail.com',
                'id' => 59,
                'updated_at' => '2023-01-29 10:01:28',
                'verification_code' => '1285',
                'verification_code_end' => '2023-01-29 10:31:28',
            ),
            3 => 
            array (
                'created_at' => '2023-01-29 10:04:25',
                'email' => 'jbull635@gmail.com',
                'id' => 60,
                'updated_at' => '2023-01-29 10:04:25',
                'verification_code' => '9965',
                'verification_code_end' => '2023-01-29 10:34:25',
            ),
            4 => 
            array (
                'created_at' => '2023-01-29 10:07:10',
                'email' => 'jbull635@gmail.com',
                'id' => 61,
                'updated_at' => '2023-01-29 10:07:10',
                'verification_code' => '5105',
                'verification_code_end' => '2023-01-29 10:37:10',
            ),
            5 => 
            array (
                'created_at' => '2023-02-01 14:51:34',
                'email' => 'jbull35@gmail.com',
                'id' => 65,
                'updated_at' => '2023-02-01 14:51:34',
                'verification_code' => '8678',
                'verification_code_end' => '2023-02-01 15:21:34',
            ),
            6 => 
            array (
                'created_at' => '2023-02-02 10:31:49',
                'email' => 'jbull635@gmail.com',
                'id' => 67,
                'updated_at' => '2023-02-02 10:31:49',
                'verification_code' => '6096',
                'verification_code_end' => '2023-02-02 11:01:49',
            ),
            7 => 
            array (
                'created_at' => '2023-03-15 18:29:09',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 73,
                'updated_at' => '2023-03-15 18:29:09',
                'verification_code' => '3135',
                'verification_code_end' => '2023-03-15 18:59:09',
            ),
            8 => 
            array (
                'created_at' => '2023-03-15 18:30:02',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 74,
                'updated_at' => '2023-03-15 18:30:02',
                'verification_code' => '9242',
                'verification_code_end' => '2023-03-15 19:00:02',
            ),
            9 => 
            array (
                'created_at' => '2023-03-15 19:04:48',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 75,
                'updated_at' => '2023-03-15 19:04:48',
                'verification_code' => '7590',
                'verification_code_end' => '2023-03-15 19:34:48',
            ),
            10 => 
            array (
                'created_at' => '2023-03-15 19:10:00',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 76,
                'updated_at' => '2023-03-15 19:10:00',
                'verification_code' => '3790',
                'verification_code_end' => '2023-03-15 19:40:00',
            ),
            11 => 
            array (
                'created_at' => '2023-03-15 19:22:14',
                'email' => 'kalifa.ndiaye@outlook.fr',
                'id' => 77,
                'updated_at' => '2023-03-15 19:22:14',
                'verification_code' => '9830',
                'verification_code_end' => '2023-03-15 19:52:14',
            ),
            12 => 
            array (
                'created_at' => '2023-03-15 19:23:12',
                'email' => 'kalifa.ndiaye@outlook.fr',
                'id' => 78,
                'updated_at' => '2023-03-15 19:23:12',
                'verification_code' => '4678',
                'verification_code_end' => '2023-03-15 19:53:12',
            ),
            13 => 
            array (
                'created_at' => '2023-03-15 19:29:12',
                'email' => 'thetrackmonster@gmail.com',
                'id' => 79,
                'updated_at' => '2023-03-15 19:29:12',
                'verification_code' => '2197',
                'verification_code_end' => '2023-03-15 19:59:12',
            ),
        ));
        
        
    }
}