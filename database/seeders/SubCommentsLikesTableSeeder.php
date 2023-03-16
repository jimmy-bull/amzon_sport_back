<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubCommentsLikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_comments_likes')->delete();
        
        \DB::table('sub_comments_likes')->insert(array (
            0 => 
            array (
                'comment_id' => 190,
                'created_at' => '2023-03-15 19:13:06',
                'id' => 91,
                'main_comment_id' => 334,
                'updated_at' => '2023-03-15 19:13:06',
                'who_liked_id' => 65169,
            ),
            1 => 
            array (
                'comment_id' => 191,
                'created_at' => '2023-03-15 19:13:28',
                'id' => 92,
                'main_comment_id' => 334,
                'updated_at' => '2023-03-15 19:13:28',
                'who_liked_id' => 54161,
            ),
            2 => 
            array (
                'comment_id' => 190,
                'created_at' => '2023-03-15 19:13:29',
                'id' => 93,
                'main_comment_id' => 334,
                'updated_at' => '2023-03-15 19:13:29',
                'who_liked_id' => 54161,
            ),
            3 => 
            array (
                'comment_id' => 192,
                'created_at' => '2023-03-15 19:34:06',
                'id' => 94,
                'main_comment_id' => 335,
                'updated_at' => '2023-03-15 19:34:06',
                'who_liked_id' => 54161,
            ),
            4 => 
            array (
                'comment_id' => 192,
                'created_at' => '2023-03-15 19:34:14',
                'id' => 95,
                'main_comment_id' => 335,
                'updated_at' => '2023-03-15 19:34:14',
                'who_liked_id' => 65169,
            ),
            5 => 
            array (
                'comment_id' => 193,
                'created_at' => '2023-03-15 19:34:36',
                'id' => 96,
                'main_comment_id' => 335,
                'updated_at' => '2023-03-15 19:34:36',
                'who_liked_id' => 65169,
            ),
            6 => 
            array (
                'comment_id' => 193,
                'created_at' => '2023-03-15 19:34:39',
                'id' => 97,
                'main_comment_id' => 335,
                'updated_at' => '2023-03-15 19:34:39',
                'who_liked_id' => 54161,
            ),
        ));
        
        
    }
}