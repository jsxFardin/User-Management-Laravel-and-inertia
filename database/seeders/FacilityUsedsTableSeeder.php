<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilityUsedsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facility_useds')->delete();
        
        \DB::table('facility_useds')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Institutional',
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Communal',
                'active' => 1,
            ),
        ));
        
        
    }
}