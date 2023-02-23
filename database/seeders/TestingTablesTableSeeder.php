<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestingTablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('testing_tables')->delete();
        
        \DB::table('testing_tables')->insert(array (
            0 => 
            array (
                'created_at' => '2022-07-08 14:11:52',
                'id' => 1,
                'lat' => 6131,
                'name' => 'Miss Kristy Deckow',
                'updated_at' => '2022-07-08 14:11:52',
            ),
            1 => 
            array (
                'created_at' => '2022-07-08 14:13:00',
                'id' => 2,
                'lat' => 4359,
                'name' => 'Robbie Trantow',
                'updated_at' => '2022-07-08 14:13:00',
            ),
        ));
        
        
    }
}