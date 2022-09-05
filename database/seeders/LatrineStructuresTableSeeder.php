<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LatrineStructuresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('latrine_structures')->delete();
        
        \DB::table('latrine_structures')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Temporary',
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Semi Permanent',
                'active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Permanent',
                'active' => 1,
            ),
        ));
        
        
    }
}