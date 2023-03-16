<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('likes')->delete();
        
        \DB::table('likes')->insert(array (
            0 => 
            array (
                'created_at' => '2023-03-15 17:11:23',
                'id' => 130,
                'post_id' => 61362,
                'updated_at' => '2023-03-15 17:11:23',
                'who_liked_id' => 54161,
            ),
            1 => 
            array (
                'created_at' => '2023-03-15 17:19:22',
                'id' => 131,
                'post_id' => 62362,
                'updated_at' => '2023-03-15 17:19:22',
                'who_liked_id' => 54161,
            ),
            2 => 
            array (
                'created_at' => '2023-03-15 17:23:48',
                'id' => 132,
                'post_id' => 62363,
                'updated_at' => '2023-03-15 17:23:48',
                'who_liked_id' => 54161,
            ),
            3 => 
            array (
                'created_at' => '2023-03-15 19:10:01',
                'id' => 133,
                'post_id' => 62362,
                'updated_at' => '2023-03-15 19:10:01',
                'who_liked_id' => 65169,
            ),
            4 => 
            array (
                'created_at' => '2023-03-15 19:10:05',
                'id' => 134,
                'post_id' => 62363,
                'updated_at' => '2023-03-15 19:10:05',
                'who_liked_id' => 65169,
            ),
            5 => 
            array (
                'created_at' => '2023-03-15 19:10:08',
                'id' => 135,
                'post_id' => 62367,
                'updated_at' => '2023-03-15 19:10:08',
                'who_liked_id' => 65169,
            ),
            6 => 
            array (
                'created_at' => '2023-03-15 19:10:10',
                'id' => 136,
                'post_id' => 62364,
                'updated_at' => '2023-03-15 19:10:10',
                'who_liked_id' => 65169,
            ),
            7 => 
            array (
                'created_at' => '2023-03-15 19:10:47',
                'id' => 137,
                'post_id' => 62353,
                'updated_at' => '2023-03-15 19:10:47',
                'who_liked_id' => 54161,
            ),
            8 => 
            array (
                'created_at' => '2023-03-15 19:33:04',
                'id' => 138,
                'post_id' => 62366,
                'updated_at' => '2023-03-15 19:33:04',
                'who_liked_id' => 54161,
            ),
            9 => 
            array (
                'created_at' => '2023-03-15 19:33:05',
                'id' => 139,
                'post_id' => 62365,
                'updated_at' => '2023-03-15 19:33:05',
                'who_liked_id' => 54161,
            ),
        ));
        
        
    }
}