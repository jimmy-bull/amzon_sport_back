<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserConnectionInfosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_connection_infos')->delete();
        
        
        
    }
}