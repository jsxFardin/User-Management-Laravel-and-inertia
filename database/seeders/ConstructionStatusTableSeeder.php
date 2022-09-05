<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConstructionStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('construction_status')->delete();
        
        \DB::table('construction_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Completed',
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ongoing',
                'active' => 1,
            ),
        ));
        
        
    }
}