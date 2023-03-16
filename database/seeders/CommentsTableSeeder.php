<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'comment' => 'J\'aime bien la photo',
                'created_at' => '2023-03-15 19:11:30',
                'id' => 334,
                'post_id' => 62362,
                'updated_at' => '2023-03-15 19:11:30',
                'who_commented_id' => 65169,
            ),
            1 => 
            array (
                'comment' => 'Bon match',
                'created_at' => '2023-03-15 19:33:11',
                'id' => 335,
                'post_id' => 62366,
                'updated_at' => '2023-03-15 19:33:11',
                'who_commented_id' => 54161,
            ),
        ));
        
        
    }
}