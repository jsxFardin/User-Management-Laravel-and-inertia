<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DonorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('donors')->delete();
        
        \DB::table('donors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Oxfam',
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Others',
                'active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'NGO_Forum',
                'active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'ACF',
                'active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'BRAC',
                'active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Army',
                'active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Caritas',
                'active' => 1,
            ),
        ));
        
        
    }
}