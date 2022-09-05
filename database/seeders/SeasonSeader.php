<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('seasons')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'months'  => 'JANUARY,FEBRUARY,MARCH,OCTOBER,NOVEMBER,DECEMBER',
            ],
            [
                'months'  => 'APRIL,MAY,JUNE,JULY,AUGUST,SEPTEMBER',
            ],
        ];

        DB::table('seasons')->insert($data);

        $this->command->info('Seasons has been created!');
    }
}
