<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SludgeTransfersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sludge_transfers')->delete();
        
        \DB::table('sludge_transfers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Septic_Tank',
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Transfer_Station',
                'active' => 1,
            ),
        ));
        
        
    }
}