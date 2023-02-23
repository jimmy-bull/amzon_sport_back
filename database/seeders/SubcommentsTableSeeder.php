<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubcommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subcomments')->delete();
        
        
        
    }
}