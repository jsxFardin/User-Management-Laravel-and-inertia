<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('camps')->delete();
        
        \DB::table('camps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'short_name' => 'C04X',
                'name' => 'CAMP 4 EXTENSION',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'short_name' => 'NRC',
                'name' => 'NAYAPARA RC',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'short_name' => 'C26',
                'name' => 'CAMP 26',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'short_name' => 'C27',
                'name' => 'CAMP 27',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'short_name' => 'C17',
                'name' => 'CAMP 17',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'short_name' => 'C04',
                'name' => 'CAMP 4',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'short_name' => 'C05',
                'name' => 'CAMP 5',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'short_name' => 'C08W',
                'name' => 'CAMP 8W',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'short_name' => 'C03',
                'name' => 'CAMP 3',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'short_name' => 'C21',
                'name' => 'CAMP 21',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'short_name' => 'C01W',
                'name' => 'CAMP 1W',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'short_name' => 'C02W',
                'name' => 'CAMP 2W',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'short_name' => 'C01E',
                'name' => 'CAMP 1E',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'short_name' => 'C02E',
                'name' => 'CAMP 2E',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'short_name' => 'KRC',
                'name' => 'KUTUPALONG RC',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'short_name' => 'TC',
                'name' => 'TRANSIT CENTRE',
                'location' => NULL,
                'longitude' => NULL,
                'latitude' => NULL,
                'area' => NULL,
                'active' => 1,
            ),
        ));
        
        
    }
}