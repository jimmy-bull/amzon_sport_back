<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubCommentsTablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_comments_tables')->delete();
        
        \DB::table('sub_comments_tables')->insert(array (
            0 => 
            array (
                'comment_id' => 0,
                'comments' => ' Merci ',
                'created_at' => '2023-03-15 19:12:51',
                'id' => 190,
                'main_comment_id' => 334,
                'updated_at' => '2023-03-15 19:12:51',
                'who_commented_id' => 54161,
            ),
            1 => 
            array (
                'comment_id' => 0,
                'comments' => '@BullJimmy 😁',
                'created_at' => '2023-03-15 19:13:14',
                'id' => 191,
                'main_comment_id' => 334,
                'updated_at' => '2023-03-15 19:13:14',
                'who_commented_id' => 65169,
            ),
            2 => 
            array (
                'comment_id' => 0,
                'comments' => ' 🥶🥶',
                'created_at' => '2023-03-15 19:33:55',
                'id' => 192,
                'main_comment_id' => 335,
                'updated_at' => '2023-03-15 19:33:55',
                'who_commented_id' => 65169,
            ),
            3 => 
            array (
                'comment_id' => 0,
                'comments' => '@BullyJimmy 🤖👾',
                'created_at' => '2023-03-15 19:34:28',
                'id' => 193,
                'main_comment_id' => 335,
                'updated_at' => '2023-03-15 19:34:28',
                'who_commented_id' => 54161,
            ),
        ));
        
        
    }
}