<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PitTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pit_types')->delete();
        
        \DB::table('pit_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Single Pit offset',
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Direct Pit',
                'active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Twin Pit offset',
                'active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Direct Pit with Soak pit',
                'active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Septic Tank',
                'active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Bio-gas Latrine',
                'active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Mobile Latrine',
                'active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Bio-fill',
                'active' => 1,
            ),
        ));
        
        
    }
}