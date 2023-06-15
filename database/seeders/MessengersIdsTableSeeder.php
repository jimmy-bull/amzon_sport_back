<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MessengersIdsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('messengers_ids')->delete();
        
        
        
    }
}