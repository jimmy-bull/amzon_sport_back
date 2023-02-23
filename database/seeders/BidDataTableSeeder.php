<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BidDataTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bid_data')->delete();
        
        
        
    }
}