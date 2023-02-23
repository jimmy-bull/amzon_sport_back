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
        
        
        
    }
}