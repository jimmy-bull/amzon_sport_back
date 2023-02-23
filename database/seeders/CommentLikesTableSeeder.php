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
        
        
        
    }
}