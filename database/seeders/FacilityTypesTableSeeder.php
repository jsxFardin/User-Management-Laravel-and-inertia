<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilityTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facility_types')->delete();
        
        \DB::table('facility_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'name' => 'Latrine',
                'active' => 1,
            ),
        ));
        
        
    }
}