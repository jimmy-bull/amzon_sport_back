<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentLikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comment_likes')->delete();
        
        \DB::table('comment_likes')->insert(array (
            0 => 
            array (
                'comment_id' => 334,
                'created_at' => '2023-03-15 19:11:40',
                'id' => 87,
                'updated_at' => '2023-03-15 19:11:40',
                'who_liked_id' => 65169,
            ),
            1 => 
            array (
                'comment_id' => 334,
                'created_at' => '2023-03-15 19:11:51',
                'id' => 88,
                'updated_at' => '2023-03-15 19:11:51',
                'who_liked_id' => 54161,
            ),
            2 => 
            array (
                'comment_id' => 335,
                'created_at' => '2023-03-15 19:33:16',
                'id' => 89,
                'updated_at' => '2023-03-15 19:33:16',
                'who_liked_id' => 54161,
            ),
            3 => 
            array (
                'comment_id' => 335,
                'created_at' => '2023-03-15 19:33:44',
                'id' => 90,
                'updated_at' => '2023-03-15 19:33:44',
                'who_liked_id' => 65169,
            ),
        ));
        
        
    }
}