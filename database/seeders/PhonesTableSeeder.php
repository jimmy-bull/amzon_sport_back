<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('phones')->delete();
        
        
        
    }
}