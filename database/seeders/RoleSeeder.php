<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name'  => 'SUPER ADMIN',
            ],
            [
                'name'  => 'MANAGER',
            ],
            [
                'name'  => 'SUPERVISOR',
            ],
            [
                'name'  => 'USER',
            ],
        ];

        DB::table('roles')->insert($data);

        $this->command->info('Roles has been created!');
    }
}
