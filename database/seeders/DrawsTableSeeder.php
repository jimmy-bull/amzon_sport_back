<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DrawsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('draws')->delete();
        
        
        
    }
}